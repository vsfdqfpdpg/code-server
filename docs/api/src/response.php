<?php

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
