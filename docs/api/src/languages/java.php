<?php

namespace Languages;

class Java extends Language
{
    protected $extension = '.java';
    private $executor = "javac";
    protected $runFile = "Main";

    public function __construct($code)
    {
        parent::__construct($code);
        if (preg_match("/public\s+class\s+(.*?)\s*{/", $this->code, $matches)) {
            $this->runFile = $matches[1];
        }
    }

    public function run()
    {
        if (preg_match("/public\s+class\s+(.*?)\s*{/", $this->code, $matches)) {
            $path = sys_get_temp_dir() . '/' .  $matches[1];
            $tmpfile = $path . $this->extension;
            file_put_contents($tmpfile, $this->code);
            $this->cmd = $this->executor . ' ' . $tmpfile . ' 2>&1 && cd /tmp && java ' . $matches[1] . ' 2>&1';
            $this->perform();
        }
    }
}
