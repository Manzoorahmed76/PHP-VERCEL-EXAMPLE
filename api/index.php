<?php
session_start();
header('Content-Type: application/json');

class TempMail {
    public $cookie = '';
    private $baseUrl = 'https://tempmail.so';

    private function updateCookie($header) {
        if (preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches)) {
            $this->cookie = implode('; ', $matches[1]);
        }
    }

    private function request($url) {
        $headers = [
            'accept: application/json',
            'referer: ' . $this->baseUrl . '/',
            'x-inbox-lifespan: 600',
            'sec-ch-ua: "Not A(Brand";v="8", "Chromium";v="132"',
            'sec-ch-ua-mobile: ?1'
        ];

        if ($this->cookie) {
            $headers[] = 'cookie: ' . $this->cookie;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);
        curl_close($ch);

        $this->updateCookie($header);
        return json_decode($body, true);
    }

    public function initialize() {
        $ch = curl_init($this->baseUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9',
            'sec-ch-ua: "Not A(Brand";v="8", "Chromium";v="132"'
        ]);
        $response = curl_exec($ch);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $headerSize);
        curl_close($ch);

        $this->updateCookie($header);
    }

    public function getInbox() {
        $url = $this->baseUrl . '/us/api/inbox?requestTime=' . time() . '&lang=us';
        return $this->request($url);
    }

    public function setCookie($cookie) {
        $this->cookie = $cookie;
    }
}

// Route based on GET parameter
$route = $_GET['route'] ?? '';

// Handle /gen route
if ($route === 'gen') {
    $mail = new TempMail();
    $mail->initialize();
    $inbox = $mail->getInbox();

    if (!isset($inbox['data']['name'])) {
        echo json_encode([
            'status' => false,
            'message' => 'Unable to generate temporary email.',
            'join' => '@BJ_Devs on Telegram',
            'Dev' => '@BJ_Coder'
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        exit;
    }

    $email = $inbox['data']['name'];
    $_SESSION['tempMailEmail'] = $email;
    $_SESSION['tempMailCookie'] = $mail->cookie;

    echo json_encode([
        'status' => 'ok',
        'mail' => $email,
        'expired_in' => '10 minutes',
        'inbox_endpoint' => '?route=inbox&email=' . urlencode($email),
        'join' => '@BJ_Devs on Telegram',
        'Dev' => '@BJ_Coder'
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    exit;
}

// Handle /inbox?email=... route
if ($route === 'inbox') {
    $emailParam = $_GET['email'] ?? '';
    if (!filter_var($emailParam, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'status' => false,
            'message' => 'Invalid or missing email.',
            'join' => '@BJ_Devs on Telegram',
            'Dev' => '@BJ_Coder'
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        exit;
    }

    if (!isset($_SESSION['tempMailEmail']) || !isset($_SESSION['tempMailCookie'])) {
        echo json_encode([
            'status' => false,
            'message' => 'Session expired or email not generated.',
            'join' => '@BJ_Devs on Telegram',
            'Dev' => '@BJ_Coder'
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        exit;
    }

    if ($_SESSION['tempMailEmail'] !== $emailParam) {
        echo json_encode([
            'status' => false,
            'message' => 'Email not found or mismatch.',
            'join' => '@BJ_Devs on Telegram',
            'Dev' => '@BJ_Coder'
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        exit;
    }

    $mail = new TempMail();
    $mail->setCookie($_SESSION['tempMailCookie']);
    $inbox = $mail->getInbox();

    $messages = [];
    if (isset($inbox['data']['inbox']) && is_array($inbox['data']['inbox'])) {
        foreach ($inbox['data']['inbox'] as $msg) {
            $messages[] = [
                'subject' => $msg['subject'] ?? 'No Subject',
                'from' => $msg['from'] ?? 'Unknown'
            ];
        }
    }

    echo json_encode([
        'status' => 'ok',
        'mail' => $emailParam,
        'messages' => $messages,
        'join' => '@BJ_Devs on Telegram',
        'Dev' => '@BJ_Coder'
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    exit;
}

// Default fallback
echo json_encode([
    'status' => false,
    'message' => 'Invalid route. Use ?route=gen or ?route=inbox&email=xyz@mail.com',
    'join' => '@BJ_Devs on Telegram',
    'Dev' => '@BJ_Coder'
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
exit;
