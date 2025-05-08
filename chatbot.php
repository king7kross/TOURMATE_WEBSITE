<?php
// chatbot.php - Backend endpoint to communicate with Gemini API

// Allow CORS for local testing (adjust as needed)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Read POST data
$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['message'])) {
    echo json_encode(['reply' => 'No message received']);
    exit;
}

$userMessage = trim($input['message']);
if (strlen($userMessage) === 0) {
    echo json_encode(['reply' => 'Empty message received']);
    exit;
}
if (strlen($userMessage) > 1000) {
    echo json_encode(['reply' => 'Message too long. Please shorten your input.']);
    exit;
}

$apiKey = 'AIzaSyB9b6_1rWmR5Px5kcYLNdF2BWwCILZ86pE';

$apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $apiKey;

$requestBody = json_encode([
    'contents' => [
        [
            'parts' => [
                ['text' => $userMessage]
            ]
        ]
    ]
]);

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($requestBody)
]);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($response === false) {
    error_log('cURL error: ' . $curlError);
    echo json_encode(['reply' => 'An internal error occurred. Please try again later.']);
    exit;
}

if ($httpCode !== 200) {
    error_log('HTTP error: ' . $httpCode . '. Response: ' . $response);
    echo json_encode(['reply' => 'Error communicating with Gemini API (HTTP code ' . $httpCode . ').']);
    exit;
}

$responseData = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log('JSON decode error: ' . json_last_error_msg());
    echo json_encode(['reply' => 'Invalid response format from Gemini API.']);
    exit;
}

if (isset($responseData['candidates'][0]['message']['content'])) {
    $botReply = $responseData['candidates'][0]['message']['content'];
    if (is_array($botReply) || is_object($botReply)) {
        if (isset($botReply['parts'][0]['text'])) {
            $botReply = $botReply['parts'][0]['text'];
        } else {
            $botReply = json_encode($botReply);
        }
    }
    echo json_encode(['reply' => $botReply]);
} elseif (isset($responseData['candidates'][0]['content'])) {
    $botReply = $responseData['candidates'][0]['content'];
    if (is_array($botReply) || is_object($botReply)) {
        if (isset($botReply['parts'][0]['text'])) {
            $botReply = $botReply['parts'][0]['text'];
        } else {
            $botReply = json_encode($botReply);
        }
    }
    echo json_encode(['reply' => $botReply]);
} else {
    error_log('Invalid response structure: ' . $response);
    echo json_encode(['reply' => 'Invalid response from Gemini API.']);
}
?>
