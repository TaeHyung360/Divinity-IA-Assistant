<?php

$apiKey = "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";

// Obtén los datos JSON de la petición POST
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Utiliza el prompt de la petición
$prompt = $data['prompt'];

//$prompt = "Saluda";

$model = "gpt-3.5-turbo";
$messages = [
    ["role" => "system", "content" => "Ahora eres RA, una IA, que ayuda con el montaje de ordenadores personalizados, eres un experto en dicha materia"],
    ["role" => "user", "content" => $prompt]
];

$data = [
    'model' => $model,
    'messages' => $messages,
    'temperature' => 0.8,
    'max_tokens' => 1000,
];

$ch = curl_init("https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $apiKey,
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);

if ($result === FALSE) {

    echo json_encode(['error' => "Hubo un problema con la solicitud."]);

} else {

    $data = json_decode($result, true); // Aquí debes cambiar $response por $result

    // Verificar si existen choices y content en la respuesta
    if (isset($data['choices'][0]['message']['content'])) {
        $content = $data['choices'][0]['message']['content'];
        echo json_encode(array("response" => $content));
    } else {
        echo json_encode(array("error" => "No se encontró el contenido en la respuesta"));
    }
}

curl_close($ch);

?>
