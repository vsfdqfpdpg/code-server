<?php

namespace Languages;

class Php extends Language
{
    protected $extension = '.php';
    private $executor = "php";

    public function run()
    {
        if (is_array($this->code)) {
            $executeFile = "";
            foreach ($this->code as $key => $code) {
                $filePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . dirname($code['filename']);
                !is_dir($filePath) && !mkdir($filePath, 0755, true);
                $file = $filePath . DIRECTORY_SEPARATOR . $code['filename'];
                file_put_contents($file, $code['content']);
                $this->files[] = $file;
                if ($key == 0) {
                    $executeFile = $file;
                }
            }
            $this->cmd = $this->executor . ' ' . $executeFile . ' 2>&1';
        } else {
            // if (!preg_match("/header\(\"content-type:\s+(.*?)\"\)/i", $decoded['code'], $match)) {
            //     $decoded['code'] = preg_replace("/<\?php/", "<?php\n    header('Content-Type: text/plain; charset=UTF-8');\n", $decoded['code'], 1);
            // }
            $tmpfile = tmpfile();
            $path = stream_get_meta_data($tmpfile)['uri'];
            fwrite($tmpfile, $this->code);
            $this->cmd = $this->executor . ' ' . $path . ' 2>&1';
        }
        $this->perform();
    }
}
