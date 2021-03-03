<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: *");


$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

$languages = [
    "php" => ["ext" => '.php', "executor" => "php"],
    "c" => ["ext" => '.c', "executor" => "gcc", "output" => "tempCodeRunnerFile"],
    "c++" => ["ext" => '.cpp', "executor" => "g++", "output" => "tempCodeRunnerFile"],
    "python" => ["ext" => '.py', "executor" => "python3 -u "],
    "javascript" => ["ext" => '.js', "executor" => "node "],
    "go" => ["ext" => '.go', "executor" => "go run ", "output" => "tempCodeRunnerFile"],
    "java" => ["ext" => '.java', "executor" => "javac", "output" => "Main"],
    "ruby" => ["ext" => '.rb', "executor" => "ruby"]
];

class Response
{
    public static function success($msg)
    {
        header("Content_Type", "application/json");
        echo json_encode(["code" => 200, "msg" => $msg]);
    }

    public static function error($msg)
    {
        header("Content_Type", "application/json");
        echo json_encode(["code" => 500, "msg" => $msg]);
    }
}

if (stripos($contentType, "application/json") != -1 && $_SERVER['REQUEST_METHOD'] == 'POST') {
    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));

    $decoded = json_decode($content, true);
    //If json_decode failed, the JSON is invalid.

    $config = $languages[strtolower($decoded['type'])];

    if (!$config) {
        Response::error(strtolower($decoded['type']) . " type is not supported.");
        exit;
    }


    if (!$config['output']) {
        $tmpfile = tmpfile();
        $path = stream_get_meta_data($tmpfile)['uri'];
        fwrite($tmpfile, $decoded['code']);
        $cmd = $config['executor'] . ' ' . $path . ' 2>&1';
    } else {
        $languageType = strtolower($decoded['type']);
        $path = sys_get_temp_dir() . '/' .  $config['output'];
        $tmpfile = $path . $config['ext'];
        if ($languageType != 'java') {
            file_put_contents($tmpfile, $decoded['code']);
        }
        $cmd = $config['executor'] . ' ' . $tmpfile . ' -o ' . $path . ' 2>&1 && chmod +x ' . $path . ' && ' . $path . ' 2>&1';
        if ($languageType == 'go') {
            $sysTempPath = sys_get_temp_dir();
            if (!file_exists($sysTempPath . '/go.mod')) {
                shell_exec("cd " . $sysTempPath . " && go mod init example.com");
            }
            $cmd = $config['executor'] . ' ' . $tmpfile . ' 2>&1';
        } elseif ($languageType == 'java') {
            if (preg_match("/public\s+class\s+(.*?)\s+{/", $decoded['code'], $matches)) {
                $path = sys_get_temp_dir() . '/' .  $matches[1];
                $tmpfile = $path . $config['ext'];
                file_put_contents($tmpfile, $decoded['code']);
                $cmd = $config['executor'] . ' ' . $tmpfile . ' 2>&1 && cd /tmp && java ' . $matches[1] . ' 2>&1';
            } else {
                Response::error(implode("\n", $output));
                exit;
            }
        }
    }
    exec($cmd, $output, $return);
    if (is_resource($tmpfile)) {
        fclose($tmpfile);
    }
    if (file_exists($tmpfile)) {
        unlink($tmpfile);
    }

    if (file_exists(str_replace("java", "class", $tmpfile))) {
        unlink(str_replace("java", "class", $tmpfile));
    }

    if ($return !== 0) {
        Response::error(implode("\n", $output));
    } else {
        Response::success(implode("\n", $output));
    }
}
