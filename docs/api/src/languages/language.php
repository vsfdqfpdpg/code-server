<?php

namespace Languages;

use Response;
use ZipArchive;

abstract class Language
{
    protected $code;
    protected $extension;
    protected $runFile = "main";
    protected $files = [];
    protected $cmd = null;

    public function __construct($code)
    {
        $this->code = $code;
    }
    abstract function run();

    public function download()
    {
        $zip = new ZipArchive();
        $filename = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "download.zip";
        if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
            exit("cannot open <$filename>\n");
        }
        if (is_array($this->code)) {
            foreach ($this->code as  $value) {
                $zip->addFromString($value['filename'], $value['content']);
            }
        } else {
            $zip->addFromString($this->runFile . $this->extension, $this->code);
        }

        $zip->close();

        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-length: " . filesize($filename));
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile($filename);
        unlink($filename);
    }

    protected function perform()
    {
        // echo $this->cmd, PHP_EOL;

        $output = null;
        $return = null;
        ob_start();
        passthru($this->cmd, $return);
        // exec($cmd, $output, $return);
        $output = ob_get_contents();
        ob_end_clean(); //Use this instead of ob_flush()
        if ($return !== 0) {
            Response::error($output);
        } else {
            Response::success($output);
        }
    }

    public function __destruct()
    {
        array_map("unlink", $this->files);
    }
}
