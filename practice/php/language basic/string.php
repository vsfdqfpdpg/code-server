<?php
$str = '🐘';
$u16 = iconv("utf-8", "utf-16", $str);
echo iconv("utf-16", "utf-8", $u16);


$languages = "php,javascript,java,python,go";
$tokenize = strtok($languages, ",");
while ($tokenize) {
    echo $tokenize . PHP_EOL;
    $tokenize = strtok(",");
}

$file = "log.svg";
$svg = fopen($file, "rb");
while (!feof($svg)) {
    echo fgets($svg);
}
fclose($svg);

$string = "中文字符";
function sub($string, $length)
{
    $new = "";
    for ($i = 0; $i < $length; $i++) {
        if (ord(substr($string, $i, 1)) > 0xa0) {
            $new .= substr($string, $i, 3);
            $i+=2;
        } else {
            $new .= substr($string, $i, 1);
        }
    }
    return $new;
}

echo sub($string, 4), PHP_EOL;
