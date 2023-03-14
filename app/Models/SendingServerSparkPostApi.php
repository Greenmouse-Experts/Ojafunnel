<?php

/**
 * SendingServerSparkPostApi class.
 *
 * Abstract class for SparkPost API sending server
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

use App\Library\Log as MailLog;

class SendingServerSparkPostApi extends SendingServerSparkPost
{
    protected $table = 'sending_servers';

    /**
     * Send the provided message.
     *
     * @return array sending results
     *
     * @param message
     */
    public function send($message, $params = array())
    {
        $response = $this->client()->transmissions->post($this->prepareEmail($message));

        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            MailLog::info('Sent!');

            return array(
                'status' => self::DELIVERY_STATUS_SENT,
            );
        } else {
            // throw the exception with body string
            throw new \Exception($response->getBody(true));
        }
    }

    /**
     * Prepare the email message to be sent by SparkPost API.
     *
     * @return array SparkPost formatted message
     *
     * @param SwiftMessage message
     */
    private function prepareEmail($message)
    {
        $toEmail = array_keys($message->getTo())[0];
        $toName = array_values($message->getTo())[0];

        // to track bounce/feedback notification
        $msgId = $message->getHeaders()->get('X-App-Message-Id')->getFieldBody();

        return [
            'content' => [
                'email_rfc822' => $message->toString(),
            ],
            'recipients' => [
                [
                    'address' => [
                        'name' => $toName,
                        'email' => $toEmail,
                    ],
                ],
            ],
            'metadata' => [
                'runtime_message_id' => $msgId,
            ],
        ];
    }
}
