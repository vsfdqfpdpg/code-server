<?php

namespace Languages;

class Go extends Language
{
    protected $extension = '.go';
    private $executor = "go run";

    public function run()
    {
        $tmpfile = sys_get_temp_dir() . '/main.go';
        file_put_contents($tmpfile, $this->code);

        $sysTempPath = sys_get_temp_dir();
        if (!file_exists($sysTempPath . '/go.mod')) {
            shell_exec("cd " . $sysTempPath . " && go mod init example.com");
        }
        $this->cmd = $this->executor . ' ' . $tmpfile . ' 2>&1';
        $this->files[] = $tmpfile;
        $this->perform();
    }
}
