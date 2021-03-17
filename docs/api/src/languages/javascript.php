<?php

namespace Languages;

class Javascript extends Language
{
    protected $extension = '.js';
    private $executor = "node";

    public function run()
    {
        $tmpfile = tmpfile();
        $path = stream_get_meta_data($tmpfile)['uri'];
        fwrite($tmpfile, $this->code);
        $this->cmd = $this->executor . ' ' . $path . ' 2>&1';
        $this->perform();
    }
}
