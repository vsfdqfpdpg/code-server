<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: *");

error_reporting(E_ALL);

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
    public static function success($output)
    {
        // JSON_INVALID_UTF8_IGNORE
        header("Content-Type", "application/json;charset=UTF-8");

        // FILEINFO_MIME_TYPE
        $finfo = new finfo(FILEINFO_MIME);
        $fileInfo =  $finfo->buffer($output);
        list($mimeType, $charset) =  explode("; charset=", $fileInfo);
        if ('text/plain' == $mimeType) {
            $code = iconv($charset, "UTF-8", $output);
            echo json_encode(["code" => 200, "msg" => $code, "mimeType" => $mimeType]);
        } else {
            echo json_encode(["code" => 200, "msg" => "data:$mimeType;base64," . base64_encode($output), "mimeType" => $mimeType]);
        }
    }

    public static function error($msg)
    {
        header("Content-Type", "application/json;charset=UTF-8");
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

    $languageType = strtolower($decoded['type']);

    if (!isset($config['output'])) {
        $tmpfile = tmpfile();
        $path = stream_get_meta_data($tmpfile)['uri'];

        if ($languageType == 'php') {
            if (!preg_match("/header\(\"content-type:\s+(.*?)\"\)/i", $decoded['code'], $match)) {
                $decoded['code'] = preg_replace("/<\?php/", "<?php\n    header('Content-Type: text/plain; charset=UTF-8');\n", $decoded['code'], 1);
            }
            fwrite($tmpfile, $decoded['code']);
            $cmd = $config['executor'] . ' ' . $path . ' 2>&1';
        } else {
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

        $output = null;
        $return = null;
        ob_start();
        passthru($cmd, $return);
        // exec($cmd, $output, $return);
        $output = ob_get_contents();
        ob_end_clean(); //Use this instead of ob_flush()


        if (is_resource($tmpfile)) {
            fclose($tmpfile);
        } else if (file_exists($tmpfile)) {
            unlink($tmpfile);
        }

        if (file_exists(str_replace("java", "class", $tmpfile))) {
            unlink(str_replace("java", "class", $tmpfile));
        }

        if ($return !== 0) {
            Response::error($output);
        } else {
            Response::success($output);
        }
    }
}
