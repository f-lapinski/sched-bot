<?php
namespace App\Scraper;

use App\Core\HttpClient;

class ScheduleScraper {
    private HttpClient $http;
    private array $config;

    public function __construct($config) {
        $this->config = $config;
        $this->http = new HttpClient($config['cookieFile']);
    }

    public function login(): void
    {
        $postData = [
            'konto' => $this->config['username'],
            'password' => $this->config['password'],
            'submit' => 'ZALOGUJ'
        ];

        $this->http->post($this->config['loginUrl'], $postData);
    }

    public function getSchedule(): string
    {
        return $this->http->get($this->config['scheduleUrl']);
    }
}
