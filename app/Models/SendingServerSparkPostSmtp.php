<?php

/**
 * SendingServerSparkPostSmtp class.
 *
 * Model class for SparkPost SMTP sending server
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

class SendingServerSparkPostSmtp extends SendingServerSparkPost
{
    protected $table = 'sending_servers';

    /**
     * Send the provided message.
     *
     * @return bool
     *
     * @param message
     */
    public function send($message, $params = [])
    {
        $transport = new \Swift_SmtpTransport($this->host, (int) $this->smtp_port, $this->smtp_protocol);
        $transport->setUsername($this->smtp_username);
        $transport->setPassword($this->smtp_password);

        // tracking bounce/feedback
        $msgId = $message->getHeaders()->get('X-App-Message-Id')->getFieldBody();
        $message->getHeaders()->addTextHeader('X-MSYS-API', json_encode(['metadata' => ['runtime_message_id' => $msgId]]));

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Actually send
        $sent = $mailer->send($message);

        if ($sent) {
            MailLog::info('Sent!');

            return array(
                'status' => self::DELIVERY_STATUS_SENT,
            );
        } else {
            throw new \Exception('Unknown SMTP error');
        }
    }
}
