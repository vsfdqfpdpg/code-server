<?php

namespace Languages;

class Java extends Language
{
    protected $extension = '.java';
    private $compiler = "javac -encoding utf8 -Xlint -Xdiags:verbose";
    private $executor = "java -Dfile.encoding=UTF-8 -Xmx128M -Xms16M";
    protected $runFile;

    public function __construct($code)
    {
        parent::__construct($code);
        if(!is_array($code)){
            if (preg_match("/public\s+class\s+(.*?)\s*(extends.*?|implements.*?)?{/", $this->code, $matches)) {
                $this->runFile = $matches[1];
            }
        }
        
    }

    public function run()
    {
        if ($this->runFile) {
            $path = sys_get_temp_dir() . '/' .  $this->runFile;
            $tmpfile = $path . $this->extension;
            file_put_contents($tmpfile, $this->code);
            $this->cmd = $this->compiler . ' ' . $tmpfile . ' 2>&1 && cd /tmp && '. $this->executor . " ". $this->runFile . ' 2>&1';
            $this->perform();
            $this->files[] = $tmpfile;
            $this->files[] = $path.'.class';
        }
    }
}
