<?php
/**
 * Funciones relacionadas con la comunicación entre Divinity IA Assistant y OpenAI GPT-4.
 */

/**
 * Consulta al modelo GPT-4 y devuelve su respuesta.
 *
 * @param string $prompt El prompt que deseas enviar a GPT-4.
 * @return string Respuesta del modelo.
 */
function mfp_query_gpt4($prompt){
    $api_key = get_option('mfp_clave', '');

    if (!$api_key) {
        return 'Error: No se ha configurado la clave API.';
    }

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci/completions', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json'
        ),
        'body' => json_encode(array(
            'prompt' => $prompt,
            'max_tokens' => 150 // O cualquier otro parámetro que desees ajustar.
        ))
    ));

    if (is_wp_error($response)) {
        return 'Error: ' . $response->get_error_message();
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (isset($data['choices'][0]['text'])) {
        return trim($data['choices'][0]['text']);
    } else {
        return 'Error: No se pudo obtener una respuesta del modelo.';
    }
}
