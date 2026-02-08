<?php
session_start();

$supported = ['ka','en','ru'];

$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'ka';
if (!in_array($lang, $supported)) $lang = 'ka';
$_SESSION['lang'] = $lang;

/**
 * lang dictionary loader (per site)
 * public_html/lang/ka.php | en.php | ru.php
 */
$dict = require __DIR__ . "/../lang/{$lang}.php";

function t(string $key, ?string $fallback = null): string {
  global $dict;
  return $dict[$key] ?? ($fallback ?? $key);
}

/**
 * Keep current query params and switch only lang
 */
function lang_url(string $newLang): string {
  $params = $_GET;
  $params['lang'] = $newLang;
  $path = strtok($_SERVER['REQUEST_URI'], '?');
  return $path . '?' . http_build_query($params);
}
