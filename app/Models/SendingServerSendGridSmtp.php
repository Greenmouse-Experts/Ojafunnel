<?php

/**
 * SendingServerSendGridApi class.
 *
 * Abstract class for SendGrid API sending server
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
use Smtpapi\Header;

class SendingServerSendGridSmtp extends SendingServerSendGrid
{
    protected $table = 'sending_servers';

    /**
     * Send the provided message.
     *
     * @return bool
     *
     * @param message
     */
    // Inherit class to implementation of this method
    public function send($message, $params = array())
    {
        $msgId = $message->getHeaders()->get('X-App-Message-Id')->getFieldBody();

        $header = new \Smtpapi\Header();
        $header->setUniqueArgs(array('runtime_message_id' => $msgId));
        $message->getHeaders()->addTextHeader(HEADER::NAME, $header->jsonString());

        if (is_null($this->subAccount)) {
            // use master account
            $username = $this->smtp_username;
            $password = $this->smtp_password;
        } else {
            // use sub account
            $username = $this->subAccount->getSubAccountUsername();
            $password = decrypt($this->subAccount->password);
        }

        $transport = new \Swift_SmtpTransport($this->host, (int) $this->smtp_port, $this->smtp_protocol);
        $transport->setUsername($username);
        $transport->setPassword($password);

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Actually send
        $sent = $mailer->send($message);

        if ($sent) {
            MailLog::info('Sent!');

            $result = array(
                'runtime_message_id' => $msgId,
                'status' => self::DELIVERY_STATUS_SENT,
            );

            if (!is_null($this->subAccount)) {
                $result['sub_account_id'] = $this->subAccount->id;
            }

            return $result;
        } else {
            throw new \Exception('Unknown SMTP error');
        }
    }
}
