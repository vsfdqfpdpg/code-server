<?php

namespace Languages;

class Python extends Language
{
    protected $extension = '.py';
    private $executor = "python3 -u";

    public function run()
    {
        $tmpfile = tmpfile();
        $path = stream_get_meta_data($tmpfile)['uri'];
        fwrite($tmpfile, $this->code);
        $this->cmd = $this->executor . ' ' . $path . ' 2>&1';
        $this->perform();
    }
}
