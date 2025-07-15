<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use stdClass;

class EvolutionWhatsApp
{
    public static $instancia;

    public static function token($value)
    {
        self::$instancia = $value;
    }

    public static function criarInstancia(String $name)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('EVOLUTION_URL') . "instance/create",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{
                \"instanceName\": \"$name\",
                \"qrcode\": true,
                \"integration\": \"WHATSAPP-BAILEYS\"
            }",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "apikey: " . env("EVOLUTION_KEY")
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return ["message" => "cURL Error #:" . $err, "erro" => $err];
        } else {
            return ["response" => $response];
        }
    }

    public static function stateInstancia(String $nomeInstancia)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('EVOLUTION_URL') . "instance/connectionState/" . $nomeInstancia,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "apikey: " . env("EVOLUTION_KEY")
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return ["message" => "cURL Error #:" . $err, "erro" => $err];
        } else {
            return ["response" => $response];
        }
    }

    public static function deletarInstancia($nomeInstancia)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('EVOLUTION_URL') . "instance/delete/" . $nomeInstancia,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => [
                "apikey: " . env("EVOLUTION_KEY")
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return ["message" => "cURL Error #:" . $err, "erro" => $err];
        } else {
            return ["response" => $response];
        }
    }
    public static function logout($nomeInstancia)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('EVOLUTION_URL') . "instance/logout/" . $nomeInstancia,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => [
                "apikey: " . env("EVOLUTION_KEY")
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return ["message" => "cURL Error #:" . $err, "erro" => $err];
        } else {
            return ["response" => $response];
        }
    }

    public static function conectar($nomeInstancia)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('EVOLUTION_URL') . "instance/connect/" . $nomeInstancia,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "apikey: " . env("EVOLUTION_KEY")
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return ["message" => "cURL Error #:" . $err, "erro" => $err];
        } else {
            return ["response" => $response];
        }
    }

    public static function sendMessage($nomeInstancia, $numero, $mensagem)
    {
        // Sanitiza o número para manter apenas dígitos
        $numeroLimpo = preg_replace('/\D/', '', $numero);

        // Monta string JSON manualmente, como nas outras funções
        $postFields = json_encode([
            "number" => "55" . $numeroLimpo,
            "text" => $mensagem
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('EVOLUTION_URL') . "message/sendText/" . $nomeInstancia,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "apikey: " . env("EVOLUTION_KEY")
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return isset(json_decode($response)->message)
                ? json_encode((object)['mensagem' => 'Enviado'])
                : $response;
        }
    }
    public static function sendMedia($nomeInstancia, $numero, $mediaBase64, $fileName, $mediaType = 'document', $caption = null)
    {
        // Sanitiza o número
        $numeroLimpo = preg_replace('/\D/', '', $numero);

        // Monta o corpo da requisição conforme o novo formato
        $payload = [
            "number"    => "55" . $numeroLimpo,
            "delay"     => 10,
            "presence"  => "composing",
            "mediatype" => $mediaType, // agora em minúsculo e sem camelCase
            "fileName"  => $fileName,
            "caption"   => $caption ?? '',
            "media"     => $mediaBase64
        ];

        $postFields = json_encode($payload);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('EVOLUTION_URL') . "message/sendMedia/" . $nomeInstancia,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "apikey:" . env('EVOLUTION_KEY')
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return isset(json_decode($response)->message)
                ? json_encode((object)['mensagem' => 'Arquivo enviado'])
                : $response;
        }
    }
}
