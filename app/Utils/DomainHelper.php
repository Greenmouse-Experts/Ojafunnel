<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;

class DomainHelper
{
    public $isfound = false;

    public function verifyARecord($domain)
    {
        $domain = parse_url($domain);
        $host = array_key_exists('host', $domain) ? $domain['host'] : $domain['path'];

        $records = dns_get_record($host, DNS_A);

        if (!empty($records)) {
            foreach ($records as $record) {
                if ($record['ip'] == env('SSL_APP_IP')) {
                    $this->isfound = true;

                    break;
                } else $this->isfound = false;
            }
        } else $this->isfound = false;

        return $this->isfound;
    }
}
