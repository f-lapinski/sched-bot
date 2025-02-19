<?php
namespace App;

use App\Scraper\ScheduleScraper;

class App {
    private array $config;

    public function __construct() {
        $this->config = require __DIR__ . '/../config/config.php';
    }

    public function run(): void
    {
        $scraper = new ScheduleScraper($this->config);

        echo "Logging in...\n";
        $scraper->login();

        echo "Fetching the schedule...\n";
        $scheduleHtml = $scraper->getSchedule();

        echo "Here is the content:\n";
        echo $scheduleHtml;
    }
}
