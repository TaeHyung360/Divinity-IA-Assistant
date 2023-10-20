<?php
$apiKey = get_option('aai_clave', '');

$data = json_decode(file_get_contents('php://input'), true);
$prompt = $data['prompt'];

$model = "gpt-3.5-turbo";
$messages = [
    ["role" => "system", "content" => "dame una respuesta larga"],
    ["role" => "user", "content" => $prompt]
];

$response = [];

$options = [
    'http' => [
        'method' => "POST",
        'header' => "Authorization: Bearer " . $apiKey . "\r\n" .
                    "Content-Type: application/json\r\n",
        'content' => json_encode([
            'model' => $model,
            'messages' => $messages,
            'temperature' => 0.8,
            'max_tokens' => 1000,
        ]),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents("https://api.openai.com/v1/engines/" . $model . "/completions", false, $context);

if ($result === FALSE) {
    $response['error'] = "Hubo un problema con la solicitud.";
} else {
    $data = json_decode($result, true);
    $response['response'] = $data['choices'][0]['message']['content'];
}

echo json_encode($response);
?>
