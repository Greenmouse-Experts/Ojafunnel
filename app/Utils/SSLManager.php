<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class SSLManager
{
    private function execute($command)
    {
        $process = new Process($command, base_path());
        $process->start();
        $process->wait(function ($type, $output) {
        });

        Log::info('process execute()');
        Log::info($process->getOutput());

        return $process;
    }

    public function certbot_command($domain, $email)
    {
        if (env('SSL_CERTBOT_ENV') == 'staging') {
            $command = explode(" ", "sudo certbot certonly --nginx --agree-tos --no-eff-email -d $domain --email $email --test-cert");
        } else {
            $command = explode(" ", "sudo certbot certonly --nginx --agree-tos --no-eff-email -d $domain --email $email");
        }

        return $command;
    }

    public function nginx_config($domain, $host)
    {
        $content = "
server {
    listen 80;
    listen [::]:80;
    server_name $domain;
    return 301 https://\$server_name\$request_uri
}
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name $domain; 
    resolver 8.8.8.8;
    location / {
        include proxy_params;
        proxy_pass https://$host\$request_uri;
        proxy_set_header Host $domain;
        proxy_set_header X-Forwarded-Host \$http_host;
        proxy_set_header X-Real-IP \$remote_addr;
        proxy_set_header X-Forwarded-For \$proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto \$scheme;
        proxy_redirect off;
        proxy_http_version 1.1;
        proxy_set_header Upgrade \$http_upgrade;
    }
    ssl_certificate /etc/letsencrypt/live/$domain/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/$domain/privkey.pem;
    ssl_trusted_certificate /etc/letsencrypt/live/$domain/chain.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;
}";

        return $content;
    }

    public function deleteConfig($file_path)
    {
        return File::exists($file_path) ? File::delete($file_path) : false;
    }

    public function generateSSL($domain, $host, $email = null)
    {
        $command = $this->certbot_command($domain, $email);
        $process = $this->execute($command);

        if ($process->isSuccessful()) {
            $file_path = "/etc/nginx/sites-available/$domain";

            if (File::exists($file_path)) {
                $nginx = File::put($file_path, $this->nginx_config($domain, $host));
            } else {
                touch($file_path);
                $nginx = File::put($file_path, $this->nginx_config($domain, $host));
            }

            if ($nginx) {
                $symlink = $this->execute(explode(" ", "sudo ln -s /etc/nginx/sites-available/$domain /etc/nginx/sites-enabled/"));

                if ($symlink->isSuccessful()) {
                    $test_config = $this->execute(explode(" ", "sudo nginx -t"));
                    $reload_nginx = $this->execute(explode(" ", "sudo systemctl reload nginx"));

                    return $test_config->isSuccessful() && $reload_nginx->isSuccessful() ? true : false;
                }
            }
        } else return false;
    }

    public function renewSSL($domain)
    {
        $command = explode(" ", "sudo certbot certonly --force-renew -d $domain");
        $process = $this->execute($command);

        return $process->isSuccessful() ? true : false;
    }

    public function deleteSSL($domain)
    {
        $this->deleteConfig("/etc/nginx/sites-available/$domain");
        $this->execute(explode(" ", "sudo rm -rf /etc/nginx/sites-enabled/$domain"));
        $this->execute(explode(" ", "sudo certbot delete --cert-name $domain --non-interactive"));

        $test_config = $this->execute(explode(" ", "sudo nginx -t"));
        $reload_nginx = $this->execute(explode(" ", "sudo systemctl reload nginx"));

        return $test_config->isSuccessful() && $reload_nginx->isSuccessful() ? true : false;
    }
}
