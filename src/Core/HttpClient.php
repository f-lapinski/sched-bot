<?php
namespace App\Core;

class HttpClient {
    private string $cookieFile;

    public function __construct($cookieFile) {
        $this->cookieFile = $cookieFile;
    }

    public function post(string $url, array $postData): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookieFile);  // Save cookies
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile); // Use saved cookies
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Ignore SSL warnings
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function get(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookieFile);  // Use saved cookies
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile); // Continue session
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Ignore SSL warnings
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
