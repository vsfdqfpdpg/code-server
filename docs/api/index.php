<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: *");

error_reporting(E_ALL);

require_once "./src/autoload.php";

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if (stripos($contentType, "application/json") != -1 && $_SERVER['REQUEST_METHOD'] == 'POST') {
    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));

    $decoded = json_decode($content, true);
    //If json_decode failed, the JSON is invalid.

    $lan = 'Languages\\' . ucfirst(str_replace('+', 'Plus', $decoded['type']));
    $action = strtolower($decoded['action']);
    $code = $decoded['code'];
    $language = new $lan($code);
    $language->$action();
}
