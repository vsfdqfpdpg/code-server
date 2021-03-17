<?php

namespace Languages;

class cPlusPlus extends Language
{
    protected $extension = '.cpp';
    private $executor = "g++";

    public function run()
    {
        $output = sys_get_temp_dir() . '/main';
        $tempFile = $output . $this->extension;
        file_put_contents($tempFile, $this->code);
        $this->cmd = $this->executor . ' ' . $tempFile . ' -o ' . $output . ' 2>&1 && chmod +x ' . $output . ' && ' . $output . ' 2>&1';
        $this->perform();
    }
}
