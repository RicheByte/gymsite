<?php
session_start();

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    exit;
}

// Get the raw POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate input
if (!isset($data['message']) || empty(trim($data['message']))) {
    http_response_code(400); // Bad Request
    echo json_encode(['reply' => 'Invalid input.']);
    exit;
}

// Sanitize user input
$userMessage = htmlspecialchars(strip_tags($data['message']), ENT_QUOTES, 'UTF-8');

// Get AI response
$aiResponse = getAIResponse($userMessage);

// Return JSON response
echo json_encode(['reply' => $aiResponse]);

/**
 * Function to call OpenAI API and get response.
 */
function getAIResponse($message) {
    $apiKey = ''; // here paste open api key
    $apiUrl = 'https://api.openai.com/v1/chat/completions';

    if (!$apiKey) {
        return "Error: AI service is unavailable.";
    }

    $payload = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful fitness assistant. Provide concise and helpful answers about workouts, nutrition, and health.'],
            ['role' => 'user', 'content' => $message]
        ],
        'max_tokens' => 150,
        'temperature' => 0.7
    ];

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if (!$response) {
        return 'Error: No response from AI service.';
    }

    $responseData = json_decode($response, true);

    // Log response for debugging
    error_log(json_encode($responseData));

    if ($httpCode !== 200 || !isset($responseData['choices'][0]['message']['content'])) {
        return "Error: Invalid response from AI service.";
    }

    return $responseData['choices'][0]['message']['content'];
}
?>
