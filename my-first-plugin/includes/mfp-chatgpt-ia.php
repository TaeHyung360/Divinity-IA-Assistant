<?php

add_shortcode("chat", function($atts, $content){

    $apiKey = get_option('mfp_clave', '');

    $output = '

    <script src="https://cdn.jsdelivr.net/npm/openai@4.12.4/index.min.js"></script>

    <script>
     function getGPT3Response(prompt, callback) {
        const apiKey = "' . esc_js($apiKey) . '"; 
        const model = "gpt-3.5-turbo";
        const messages = [
            { "role": "system", "content": "dame una respuesta larga" },
            { "role": "user", "content": prompt }
        ];

        fetch("https://api.openai.com/v1/engines/" + model + "/completions", {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + apiKey,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                model: model,
                messages: messages,
                temperature: 0.8,
                max_tokens: 1000,
            })
        })
        .then(response => response.json())
        .then(data => {
            callback(data.choices[0].message.content);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }
    </script>
    ';

    return $output;
});