<?php
    // Verifico si es una solicitud POST.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Verificamos que la acción esperada se reciba.
        if (isset($_POST['action']) && $_POST['action'] == 'chat_action') {
        
            // Establezco la clave API de OpenAI directamente.

            
            $apiKey = get_option('aai_clave','');
            //var_dump($apiKey); // cadena de la clave API.
            $prompt = $_POST['prompt'] ?? ''; //comprobar si una variable existe y no es null, y si es así, devuelve su valor. Si no existe o su valor es null, devuelve el valor que se encuentra a la derecha del operador.
            if (empty($prompt)) {
                echo json_encode(array("error" => "El prompt no puede estar vacío."));
                exit;
            }
            // Defino qué modelo de OpenAI voy a utilizar y establezco los mensajes iniciales para la conversación
            $model = "gpt-4";
            //$model = "gpt-3.5-turbo";
            $messages = [
                ["role" => "system", "content" => "Ahora eres RA, una IA, que ayuda con el montaje de ordenadores personalizados, eres un experto en dicha materia"],
                ["role" => "user", "content" => $prompt]
            ];

            // Configuro los parámetros para la petición a la API de OpenAI.
            $data = [
                'model' => $model,
                'messages' => $messages,
                'temperature' => 0.8,
                'max_tokens' => 1000,
            ];
            //var_dump(json_encode($data));
            //cURL: herramienta y una biblioteca de funciones para transferir datos entre servidores
            // Inicializo cURL para hacer la petición HTTP POST a OpenAI
            $ch = curl_init("https://api.openai.com/v1/chat/completions");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer " . $apiKey,
                "Content-Type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            // Ejecuto la petición y almaceno el resultado
            $result = curl_exec($ch);

            // Verifico si la petición se ejecutó correctamente
            if ($result === FALSE) {
                // En caso de error, envío un mensaje de error
                echo 'cURL error: ' . curl_error($ch);
                echo json_encode(['error' => "Hubo un problema con la solicitud."]);
                curl_close($ch);
                exit;
            } else {
                // Si todo salió bien, decodifico la respuesta de OpenAI
                $data = json_decode($result, true);
                curl_close($ch);
                // Verifico si la respuesta contiene el contenido esperado
                if (isset($data['choices'][0]['message']['content'])) {
                    $content = $data['choices'][0]['message']['content'];
                    // Si se encuentra el contenido, lo envío como respuesta
                    echo json_encode(array("response" => $content));
                } else {
                    // Si no se encuentra el contenido en la respuesta, envío un mensaje de error
                    echo json_encode(array("error" => "No se encontró el contenido en la respuesta"));
                }
            }
        }

    }

?>
