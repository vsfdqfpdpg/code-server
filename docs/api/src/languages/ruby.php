<?php

namespace Languages;

class Ruby extends Language
{
    protected $extension = '.rb';
    private $executor = "ruby";

    public function run()
    {
        $tmpfile = tmpfile();
        $path = stream_get_meta_data($tmpfile)['uri'];
        fwrite($tmpfile, $this->code);
        $this->cmd = $this->executor . ' ' . $path . ' 2>&1';
        $this->perform();
    }
}
