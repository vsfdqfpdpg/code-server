<?php

namespace Languages;

class C extends Language
{
    protected $extension = '.c';
    private $executor = "gcc";

    public function run()
    {
        $output = sys_get_temp_dir() . '/main';
        $tempFile = $output . $this->extension;
        file_put_contents($tempFile, $this->code);
        $this->cmd = $this->executor . ' ' . $tempFile . ' -o ' . $output . ' 2>&1 && chmod +x ' . $output . ' && ' . $output . ' 2>&1';
        $this->perform();
    }
}
