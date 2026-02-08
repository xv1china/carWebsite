<?php
// admin/includes/translate.php

// 1) დაამატე ეს კონფიგში (რეკომენდებული):
// define('GOOGLE_TRANSLATE_API_KEY', 'YOUR_KEY_HERE');
//
// ან .env / config-დან წაიკითხე.
// თუ KEY ცარიელია, ფუნქცია უბრალოდ დააბრუნებს original ტექსტს (fallback).

function translate_text(string $text, string $target, string $source = 'ka'): string {
    $text = trim($text);
    if ($text === '') return '';

    if (!defined('GOOGLE_TRANSLATE_API_KEY') || !GOOGLE_TRANSLATE_API_KEY) {
        // fallback: key არ გაქვს ჯერ
        return $text;
    }

    $endpoint = 'https://translation.googleapis.com/language/translate/v2?key=' . urlencode(GOOGLE_TRANSLATE_API_KEY);

    $payload = http_build_query([
        'q'      => $text,
        'source' => $source,
        'target' => $target,
        'format' => 'text', // თუ HTML გინდა: 'html'
    ]);

    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 12,
    ]);

    $resp = curl_exec($ch);
    $err  = curl_error($ch);
    $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($resp === false || $err || $code < 200 || $code >= 300) {
        // fallback თუ რამე დაემართა API-ს
        return $text;
    }

    $json = json_decode($resp, true);
    $out = $json['data']['translations'][0]['translatedText'] ?? '';

    // API ზოგჯერ აბრუნებს HTML entities-ით
    if ($out !== '') {
        $out = html_entity_decode($out, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return $out;
    }

    return $text;
}

// ერთდროულად რომ გამოიძახო:
function translate_pack_ka(string $kaText): array {
    $en = translate_text($kaText, 'en', 'ka');
    $ru = translate_text($kaText, 'ru', 'ka');
    return [$kaText, $en, $ru];
}
