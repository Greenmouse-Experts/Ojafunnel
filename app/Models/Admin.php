<?php

/**
 * Admin class.
 *
 * Model class for admin
 *
 * LICENSE: This product includes software developed at
 * the App Co., Ltd. (http://Appmail.com/).
 *
 * @category   MVC Model
 *
 * @author     N. Pham <n.pham@Appmail.com>
 * @author     L. Pham <l.pham@Appmail.com>
 * @copyright  App Co., Ltd
 * @license    App Co., Ltd
 *
 * @version    1.0
 *
 * @link       http://Appmail.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;
use App\Library\Traits\TrackJobs;
use App\Jobs\ImportBlacklistJob;
use App\Library\Traits\HasUid;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use TrackJobs;
    use HasUid;

    public const STATUS_ACTIVE = 'active';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'timezone',
        'language_id',
        'color_scheme',
        'text_direction',
        'menu_layout',
        'theme_mode',
        'fcm_token',
        'backup_amt',
        'months_nonactive_user',
    ];

    /**
     * Associations.
     *
     * @var object | collect
     */
    public function contact()
    {
        return $this->belongsTo('App\Models\Contact');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function adminGroup()
    {
        return $this->belongsTo('App\Models\AdminGroup');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer');
    }

    public function templates()
    {
        return $this->hasMany('App\Models\Template');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    /**
     * Check if admin has customer account.
     *
     * @return bool
     */
    public function hasCustomerAccount()
    {
        return is_object($this->user) && is_object($this->user->customer);
    }

    /**
     * Get all items.
     *
     * @return collect
     */
    public static function getAll()
    {
        return self::select('*');
    }

    /**
     * Items per page.
     *
     * @var array
     */
    public static $itemsPerPage = 25;

    /**
     * Filter items.
     *
     * @return collect
     */
    public static function filter($request)
    {
        $query = self::select('admins.*')
            ->join('users', 'users.id', '=', 'admins.user_id')
            ->leftJoin('admin_groups', 'admin_groups.id', '=', 'admins.admin_group_id');

        // Keyword
        if (!empty(trim($request->keyword))) {
            foreach (explode(' ', trim($request->keyword)) as $keyword) {
                $query = $query->where(function ($q) use ($keyword) {
                    $q->orwhere('users.first_name', 'like', '%' . $keyword . '%')
                        ->orWhere('admin_groups.name', 'like', '%' . $keyword . '%')
                        ->orWhere('users.last_name', 'like', '%' . $keyword . '%');
                });
            }
        }

        // filters
        $filters = $request->all();
        if (!empty($filters)) {
            if (!empty($filters['admin_group_id'])) {
                $query = $query->where('admins.admin_group_id', '=', $filters['admin_group_id']);
            }
        }

        if (!empty($request->creator_id)) {
            $query = $query->where('admins.creator_id', '=', $request->creator_id);
        }

        return $query;
    }

    /**
     * Search items.
     *
     * @return collect
     */
    public static function search($request)
    {
        $query = self::filter($request);

        if (!empty($request->sort_order)) {
            $query = $query->orderBy($request->sort_order, $request->sort_direction);
        }

        return $query;
    }

    /**
     * Get admin setting.
     *
     * @return string
     */
    public function getOption($name)
    {
        return $this->adminGroup->getOption($name);
    }

    /**
     * Get admin permission.
     *
     * @return string
     */
    public function getPermission($name)
    {
        return $this->adminGroup->getPermission($name);
    }

    /**
     * Get user's color scheme.
     *
     * @return string
     */
    public function getColorScheme()
    {
        if (!empty($this->color_scheme)) {
            return $this->color_scheme;
        } else {
            return \App\Models\Setting::get('backend_scheme');
        }
    }

    /**
     * Color array.
     *
     * @return array
     */
    public static function colors($default)
    {
        return [
            ['value' => '', 'text' => trans('messages.system_default')],
            ['value' => 'blue', 'text' => trans('messages.blue')],
            ['value' => 'green', 'text' => trans('messages.green')],
            ['value' => 'brown', 'text' => trans('messages.brown')],
            ['value' => 'pink', 'text' => trans('messages.pink')],
            ['value' => 'grey', 'text' => trans('messages.grey')],
            ['value' => 'white', 'text' => trans('messages.white')],
        ];
    }

    /**
     * Disable admin.
     *
     * @return bool
     */
    public function disable()
    {
        $this->status = 'inactive';

        return $this->save();
    }

    /**
     * Enable admin.
     *
     * @return bool
     */
    public function enable()
    {
        $this->status = 'active';

        return $this->save();
    }

    /**
     * Get recent resellers.
     *
     * @return collect
     */
    public function getAllCustomers()
    {
        $query = \App\Models\Customer::getAll();
        //$query = $query->latest()->get();
        // if (!$this->user->can('readAll', new \App\Models\Customer())) {
        //     $query = $query->where('customers.admin_id', '=', $this->id);
        // }

        return $query;
    }

    public function getAllCustomerLists()
    {

        return $this->getAllCustomers()->latest()->get();

    }

    public function getAllStores()
    {
        $query = \App\Models\Store::getAll();
        $query = $query->latest()->get();
        // if (!$this->user->can('readAll', new \App\Models\Customer())) {
        //     $query = $query->where('customers.admin_id', '=', $this->id);
        // }

        return $query;
    }

    public function getAllProducts()
    {
        $query = \App\Models\StoreProduct::getAll();
        $query = $query->latest()->get();
        // if (!$this->user->can('readAll', new \App\Models\Customer())) {
        //     $query = $query->where('customers.admin_id', '=', $this->id);
        // }

        return $query;
    }

    public function getAllOrders()
    {
        $query = \App\Models\StoreOrder::getAll();
        $query = $query->latest()->get();
        // if (!$this->user->can('readAll', new \App\Models\Customer())) {
        //     $query = $query->where('customers.admin_id', '=', $this->id);
        // }

        return $query;
    }

    public function getAllTransactions()
    {
        $query = \App\Models\Transaction::getAll();
        // if (!$this->user->can('readAll', new \App\Models\Customer())) {
        //     $query = $query->where('customers.admin_id', '=', $this->id);
        // }

        return $query;
    }

    public function getAllTransactionLists()
    {

        return $this->getAllTransactions()->latest()->get();

    }

    public function getAllActiveCustomers()
    {
        $query = \App\Models\Customer::getAll();

        // if (!$this->user->can('readAll', new \App\Models\Customer())) {
        //     $query = $query->where('customers.admin_id', '=', $this->id);
        // }
        $query = $query->where('status', 'active');
        return $query;
    }

    public function recentTransactions()
    {
        return $this->getAllTransactions()->orderBy('created_at', 'DESC')->limit(5)->get();
    }

    /**
     * Get recent resellers.
     *
     * @return collect
     */
    public function recentCustomers()
    {
        return $this->getAllCustomers()->orderBy('created_at', 'DESC')->limit(5)->get();
    }

    /**
     * Get all admin's subcriptions.
     *
     * @return collect
     */
    public function getAllSubscriptions()
    {
        if ($this->user->can('readAll', new \App\Models\Customer())) {
            $query = Subscription::select('subscriptions.*')->leftJoin('customers', 'customers.id', '=', 'subscriptions.customer_id');
        } else {
            $query = Subscription::select('subscriptions.*')
                ->join('customers', 'customers.id', '=', 'subscriptions.customer_id')
                ->where('customers.admin_id', '=', $this->id);
            /* ERROR
            $query = $query->where(function ($q) {
            $q->orwhere('customers.admin_id', '=', $this->id)
            ->orWhere('subscriptions.admin_id', '=', $this->id);
            });
            */
        }

        return $query;
    }

    /**
     * Get subscription notification count.
     *
     * @return collect
     */
    public function subscriptionNotificationCount()
    {
        $query = $this->getAllSubscriptions()
            ->where('subscriptions.ends_at', '>=', \Carbon\Carbon::now()->endOfDay())
            ->count();

        return $query == 0 ? '' : $query;
    }

    /**
     * Get recent subscriptions.
     *
     * @return collect
     */
    public function recentSubscriptions($number = 5)
    {
        $query = $this->getAllSubscriptions()
            ->whereNull('ends_at')->orWhere('ends_at', '>=', \Carbon\Carbon::now())
            ->orderBy('subscriptions.created_at', 'desc')->limit($number);

        return $query->get();
    }

    /**
     * Get admin language code.
     *
     * @return string
     */
    public function getLanguageCode()
    {
        return is_object($this->language) ? $this->language->code : null;
    }

    /**
     * Get customer language code.
     *
     * @return string
     */
    public function getLanguageCodeFull()
    {
        $region_code = $this->language->region_code ? strtoupper($this->language->region_code) : strtoupper($this->language->code);
        return is_object($this->language) ? ($this->language->code . '-' . $region_code) : null;
    }

    /**
     * Get admin logs of their customers.
     *
     * @return string
     */
    public function getLogs()
    {
        $query = \App\Models\Log::select('logs.*')->join('customers', 'customers.id', '=', 'logs.customer_id')
            ->leftJoin('admins', 'admins.id', '=', 'customers.admin_id');

        if (!$this->user->can('readAll', new \App\Models\Customer())) {
            $query = $query->where('admins.id', '=', $this->id);
        }

        return $query;
    }

    /**
     * Create customer account.
     */
    public function createCustomerAccount()
    {
        $customer = \App\Models\Customer::newCustomer();
        $customer->admin_id = $this->id;
        $customer->language_id = $this->language_id;
        // [moved] $customer->first_name = $this->first_name;
        // [moved] $customer->last_name = $this->last_name;
        $customer->timezone = $this->timezone;
        $customer->status = $this->status;
        $customer->save();

        return $customer;
    }

    /**
     * Check if customer is disabled.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->status == Customer::STATUS_ACTIVE;
    }

    /**
     * Custom can for admin.
     *
     * @return bool
     */
    public function can($action, $item = null)
    {
        if ($item) {
            return $this->user->can($action, [$item, 'admin']);
        } else {
            return $this->user->can($action, ['admin']);
        }
    }

    /**
     * Destroy admin.
     *
     * @return bool
     */
    public function deleteAccount()
    {
        // unset all customers
        $this->customers()->update(['admin_id' => null]);

        // Delete admin and user
        $user = $this->user;

        $this->delete();

        if (!$user->customer()->exists()) {
            $user->deleteAndCleanup();
        }
    }

    /**
     * Get all subscription count by plan.
     *
     * @return int
     */
    public function getAllSubscriptionsByPlan($plan)
    {
        return $this->getAllSubscriptions()->where('subscriptions.plan_id', '=', $plan->id);
    }

    /**
     * Get all plans.
     *
     * @return int
     */
    public function getAllPlans()
    {
        return \App\Models\Plan::active();
    }

    /**
     * Get all admin.
     *
     * @return int
     */
    public function getAllAdmins()
    {
        $query = \App\Models\Admin::getAll()
            ->where('admins.status', '=', \App\Models\Admin::STATUS_ACTIVE);

        if (!$this->can('readAll', new \App\Models\Admin())) {
            $query = $query->where('admins.creator_id', '=', $this->user_id);
        }

        return $query;
    }

    /**
     * Get all admin.
     *
     * @return int
     */
    public function getAllAdminGroups()
    {
        $query = \App\Models\AdminGroup::getAll();

        if (!$this->can('readAll', new \App\Models\AdminGroup())) {
            $query = $query->where('admin_groups.creator_id', '=', $this->user_id);
        }

        return $query;
    }

    /**
     * Get all sending servers.
     *
     * @return int
     */
    public function getAllSendingServers()
    {
        $query = \App\Models\SendingServer::getAll();

        if (!$this->can('readAll', new \App\Models\SendingServer())) {
            $query = $query->where('sending_servers.admin_id', '=', $this->id);
        }

        // remove customer sending servers
        $query = $query->whereNull('customer_id');

        return $query;
    }

    /**
     * Get all campaigns.
     *
     * @return collect
     */
    public function getAllCampaigns()
    {
        $query = \App\Models\Campaign::getAll();

        if (!$this->can('readAll', new \App\Models\Customer())) {
            $query = $query->leftJoin('customers', 'customers.id', '=', 'campaigns.customer_id')
                ->where('customers.admin_id', '=', $this->id);
        }

        return $query;
    }

    /**
     * Get all lists.
     *
     * @return collect
     */
    public function getAllLists()
    {
        $query = \App\Models\MailList::getAll();

        if (!$this->can('readAll', new \App\Models\Customer())) {
            $query = $query->leftJoin('customers', 'customers.id', '=', 'mail_lists.customer_id')
                ->where('customers.admin_id', '=', $this->id);
        }

        return $query;
    }

    /**
     * Get sub-account sending servers.
     *
     * @return int
     */
    public function getSubaccountSendingServers()
    {
        $query = $this->getAllSendingServers();

        $query = $query->whereIn('type', \App\Models\SendingServer::getSubAccountTypes());

        return $query;
    }

    /**
     * Get sub-account sending servers options.
     *
     * @return int
     */
    public function getSubaccountSendingServersSelectOptions()
    {
        $options = [];

        foreach ($this->getSubaccountSendingServers()->get() as $server) {
            $options[] = ['value' => $server->uid, 'text' => $server->name];
        }

        return $options;
    }

    /**
     * Get system notification.
     *
     * @return int
     */
    public function notifications()
    {
        return Notification::orderBy('created_at', 'desc');
    }

    public function importBlacklistJobs()
    {
        return $this->jobMonitors()->orderBy('job_monitors.id', 'DESC')->where('job_type', ImportBlacklistJob::class);
    }

    public function getMenuLayout()
    {
        return ($this->menu_layout == 'left' ? 'left' : 'top');
    }

    public static function newAdmin()
    {
        $admin = new self();
        $admin->menu_layout = \App\Models\Setting::get('layout.menu_bar');

        return $admin;
    }

    public function chats ()
    {
        return $this->hasMany(Chat::class);
    }
}
