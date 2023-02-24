<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log as MailLog;

class SmsCampaign extends Model
{
    use HasFactory;

    const STATUS_NEW = 'new';
    const STATUS_QUEUED = 'queued';
    const STATUS_SENDING = 'sending';
    const STATUS_FAILED = 'failed';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_PROCESSING = 'processing';


    /*
     * Campaign type
     */
    const TYPE_ONETIME = 'onetime';
    const TYPE_RECURRING = 'recurring';

    // Campaign settings
    const WORKER_DELAY = 1;

    const UPDATED_AT = null;
    protected $fillable = ['title', 'message', 'receivers', 'user_id', 'sender_name', 'optout_message', 'integration', 'schedule_date', 'schedule_time', 'status', 'sms_type'];

    public function contactList(): HasMany
    {
        return $this->hasMany(SmsCampaignList::class, 'sms_campaign_id');
    }
    public static function scheduleCycleValues(): array
    {
        return [
            'daily' => [
                'frequency_amount' => 1,
                'frequency_unit' => 'day',
            ],
            'monthly' => [
                'frequency_amount' => 1,
                'frequency_unit' => 'month',
            ],
            'yearly' => [
                'frequency_amount' => 1,
                'frequency_unit' => 'year',
            ],
        ];
    }

    public function running()
    {
        $this->status = self::STATUS_PROCESSING;
        $this->run_at = Carbon::now();
        $this->save();
    }

    /**
     * mark campaign as failed
     *
     * @param  null  $reason
     */
    public function failed($reason = null)
    {
        $this->status = self::STATUS_FAILED;
        $this->reason = $reason;
        $this->save();
    }

    /**
     * set campaign warning
     *
     * @param  null  $reason
     */
    public function warning($reason = null)
    {
        $this->reason = $reason;
        $this->save();
    }

    /**
     * Frequency time unit options.
     *
     * @return array
     */
    public static function timeUnitOptions(): array
    {
        return [
            ['value' => 'day', 'text' => 'day'],
            ['value' => 'week', 'text' => 'week'],
            ['value' => 'month', 'text' => 'month'],
            ['value' => 'year', 'text' => 'year'],
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function preparedDataToSend()
    {

        try {
            // clean up the tracker to prevent the log file from growing very big
            $this->user->customer->cleanupQuotaTracker();

            // set campaign queued to processing
            $this->running();

            // Reset max_execution_time so that command can run for a long time without being terminated
            Tool::resetMaxExecutionTime();

            $this->singleProcess();

        } catch (Exception $exception) {
            $this->failed($exception->getMessage());
        } catch (Throwable $e) {
            $this->failed($e->getMessage());
        }

    }

    /**
     * @return $this
     */
    public function refreshStatus(): SmsCampaign
    {
        $campaign = self::find($this->id);
        $this->status = $campaign->status;
        $this->save();

        return $this;
    }
    /**
     * Mark the campaign as delivered.
     */
    public function delivered()
    {
        $this->status = self::STATUS_DELIVERED;
        $this->delivery_at = Carbon::now();
        $this->save();
    }

    /**
     * Mark the campaign as delivered.
     */
    public function cancelled()
    {
        $this->status = self::STATUS_CANCELLED;
        $this->save();
    }

    /**
     * Mark the campaign as processing.
     */
    public function processing()
    {
        $this->status = self::STATUS_PROCESSING;
        $this->running_pid = getmypid();
        $this->run_at = Carbon::now();
        $this->save();
    }

    /**
     * render sms with tag
     *
     * @param $msg
     * @param $data
     *
     * @return string|string[]
     */
    public function renderSMS($msg, $data)
    {
        preg_match_all('~{(.*?)}~s', $msg, $datas);

        foreach ($datas[1] as $value) {
            if (array_key_exists($value, $data)) {
                $msg = preg_replace("/\b$value\b/u", $data[$value], $msg);
            } else {
                $msg = str_ireplace($value, '', $msg);
            }
        }

        return str_ireplace(["{", "}"], '', $msg);
    }


    /**
     * contact count
     *
     * @param  false  $cache
     *
     * @return mixed|null
     */
    public function contactCount(bool $cache = false)
    {
        if ($cache) {
            return $this->readCache('ContactCount', 0);
        }
        $list_ids = $this->contactList()->select('contact_list_id')->cursor()->pluck('contact_list_id')->all();
        $list_count = ContactNumber::whereIn('contact_list_id', $list_ids)->where('status', 'subscribe')->count();

        $recipients_count = $this->recipients()->count();

        return $list_count + $recipients_count;

    }

    /**
     * show delivered count
     *
     * @param  false  $cache
     *
     * @return int
     */
    public function deliveredCount(bool $cache = false): int
    {
        if ($cache) {
            return $this->readCache('DeliveredCount', 0);
        }

        return $this->reports()->where('campaign_id', $this->id)->where('status', 'like', '%Delivered%')->count();
    }

    /**
     * show failed count
     *
     * @param  false  $cache
     *
     * @return int
     */
    public function failedCount(bool $cache = false): int
    {
        if ($cache) {
            return $this->readCache('FailedDeliveredCount', 0);
        }

        return $this->reports()->where('campaign_id', $this->id)->where('status', 'not like', '%Delivered%')->count();
    }

    /**
     * show not delivered count
     *
     * @param  false  $cache
     *
     * @return int
     */
    public function notDeliveredCount(bool $cache = false): int
    {
        if ($cache) {
            return $this->readCache('NotDeliveredCount', 0);
        }

        return $this->reports()->where('campaign_id', $this->id)->where('status', 'like', '%Sent%')->count();
    }

    public function nextScheduleDate($startDate, $interval, $intervalCount)
    {
        //\Log::info(Carbon::parse($startDate)->addDays($intervalCount)->toDateTimeString());
        return match ($interval) {
            'month' => Carbon::parse($startDate)->addMonthsNoOverflow($intervalCount)->toDateTimeString(),
            'day' => Carbon::parse($startDate)->addDays($intervalCount)->toDateTimeString(),
            'week' => Carbon::parse($startDate)->addWeeks($intervalCount)->toDateTimeString(),
            'year' => Carbon::parse($startDate)->addYearsNoOverflow($intervalCount)->toDateTimeString(),
            default => null,
        };
    }

    public function getCampaignType(): string
    {
        $sms_type = $this->schedule_type;

        if ($sms_type == 'onetime') {
            return '<div>
                        <span class="badge badge-light-info text-uppercase me-1 mb-1">' . "scheduled" . '</span>
                        <p class="text-muted">' . Carbon::parse($this->schedule_time)->isoFormat('llll') . '</p>
                    </div>';
        }
        if ($sms_type == 'recurring') {
            return '<div>
                        <span class="badge badge-light-success text-uppercase me-1 mb-1">' . 'recurring' . '</span>
                        <p class="text-muted">' . 'Every' . ' ' . $this->displayFrequencyTime() . '</p>
                        <p class="text-muted">' . 'Next Schedule Time' . ': ' . Carbon::parse($this->schedule_time)->isoFormat('llll') . '</p>
                        <p class="text-muted">' . 'End time' . ': ' . Carbon::parse($this->recurring_end)->isoFormat('llll') . '</p>
                    </div>';
        }

        return '<span class="badge badge-light-primary text-uppercase me-1 mb-1">' . 'normal' . '</span>';
    }

    public function getStatus(): string
    {
        $status = $this->status;

        if ($status == self::STATUS_FAILED || $status == self::STATUS_CANCELLED) {
            return '<div>
                        <span class="badge bg-danger text-uppercase me-1 mb-1">' . $status . '</span>
                        <p class="text-muted" data-toggle="tooltip" data-placement="top" title="' . $this->reason . '">' . str_limit($this->reason, 40) . '</p>
                    </div>';
        }
        if ($status == self::STATUS_SENDING || $status == self::STATUS_PROCESSING) {
            return '<div>
                        <span class="badge bg-primary text-uppercase mr-1 mb-1">' . $status . '</span>
                        <p class="text-muted">' . 'Run At' . ': ' . Carbon::parse($this->run_at)->isoFormat('llll') . '</p>
                    </div>';
        }

        if ($status == self::STATUS_SCHEDULED) {
            return '<span class="badge bg-info text-uppercase mr-1 mb-1">' . 'scheduled' . '</span>';
        }
        if ($status == self::STATUS_NEW || $status == self::STATUS_QUEUED) {
            return '<span class="badge bg-primary text-uppercase mr-1 mb-1">' . $status . '</span>';
        }


        return '<div>
                        <span class="badge bg-success text-uppercase mr-1 mb-1">' . 'delivered' . '</span>
                        <p class="text-muted">' . 'Delivered At' . ': ' . Carbon::parse($this->delivery_at)->isoFormat('llll') . '</p>
                    </div>';
    }

    public function displayFrequencyTime(): string
    {
        return $this->frequency_amount . ' ' . $this->getPluralParse($this->frequency_unit, $this->frequency_amount);
    }

    public static function getPluralParse($phrase, $value): string
    {
        $plural = '';
        if ($value > 1) {
            for ($i = 0; $i < strlen($phrase); ++$i) {
                if ($i == strlen($phrase) - 1) {
                    $plural .= ($phrase[$i] == 'y' && $phrase != 'day') ? 'ies' : (($phrase[$i] == 's' || $phrase[$i] == 'x' || $phrase[$i] == 'z' || $phrase[$i] == 'ch' || $phrase[$i] == 'sh') ? $phrase[$i] . 'es' : $phrase[$i] . 's');
                } else {
                    $plural .= $phrase[$i];
                }
            }

            return $plural;
        }

        return $phrase;
    }

    /**
     * Update Campaign cached data.
     *
     * @param  null  $key
     */
    public function updateCache($key = null)
    {
        // cache indexes
        $index = [
            'DeliveredCount' => function ($campaign) {
                return $campaign->deliveredCount();
            },
            'FailedDeliveredCount' => function ($campaign) {
                return $campaign->failedCount();
            },
            'NotDeliveredCount' => function ($campaign) {
                return $campaign->notDeliveredCount();
            },
            'ContactCount' => function ($campaign) {
                return $campaign->contactCount(true);
            },
        ];

        // retrieve cached data
        $cache = json_decode($this->cache, true);
        if (is_null($cache)) {
            $cache = [];
        }

        if (is_null($key)) {
            foreach ($index as $key => $callback) {
                $cache[$key] = $callback($this);
            }
        } else {
            $callback = $index[$key];
            $cache[$key] = $callback($this);
        }

        // write back to the DB
        $this->cache = json_encode($cache);
        $this->save();
    }

    /**
     * Retrieve Campaign cached data.
     *
     * @param $key
     * @param  null  $default
     *
     * @return mixed
     */
    public function readCache($key, $default = null)
    {
        $cache = json_decode($this->cache, true);
        if (is_null($cache)) {
            return $default;
        }
        if (array_key_exists($key, $cache)) {
            if (is_null($cache[$key])) {
                return $default;
            } else {
                return $cache[$key];
            }
        } else {
            return $default;
        }
    }

    public function singleProcess($partition = null)
    {
        $campaign = self::find($this->id);
        $prepareForTemplateTag = [];
        $contactsData = [];
        $cutting_array = [];
        $total_list_contacts = 0;

        \Log::info($campaign->integration);
    }

}
