# Welcome to MkDocs
[learnxinyminutes](https://learnxinyminutes.com/)   
[rosettacode](https://rosettacode.org/wiki/Special:Categories)   
[w3schools](https://www.w3schools.com/)   
[runoob](https://www.runoob.com/)   
[w3school](https://www.w3school.com.cn/)    
[tutorialspoint](https://www.tutorialspoint.com/)   
[geeksforgeeks](https://www.geeksforgeeks.org/)   
[how-to-list-object-methods](https://flaviocopes.com/how-to-list-object-methods-javascript/)   
[khanacademy](https://www.khanacademy.org/)   
[egghead](https://egghead.io/)   
[codewars](https://www.codewars.com/)   
[alternativeto](https://alternativeto.net/software/w3schools/)   
[coderbyte](https://coderbyte.com/)   
[freecodecamp](https://www.freecodecamp.org/)   
[EbookFoundation](https://github.com/EbookFoundation/free-programming-books)
[java 11cheatsheet](https://introcs.cs.princeton.edu/java/11cheatsheet/)   
[javascript cheatsheet](https://www.debuggex.com/cheatsheet/regex/javascript)   
[javatpoint](https://www.javatpoint.com/)   
[example-code](https://www.example-code.com/)   
[paiza](https://paiza.io/)   
[dooccn](http://www.dooccn.com/php7/)   
[practity](https://practity.com/)   
[edabit](https://edabit.com/)   
[phppot](https://phppot.com/)   

[writephponline](http://www.writephponline.com/)   
[onlinephpfunctions](http://sandbox.onlinephpfunctions.com/)   
[paiza](https://paiza.io/en/projects/new)   
[phptester](http://phptester.net/)   
[tutorialspoint](https://www.tutorialspoint.com/execute_php_online.php)   
[rextester](https://rextester.com/l/php_online_compiler)   
[phpfiddle](http://phpfiddle.org/)   
[repl](https://repl.it/languages/php_cli)   
[jdoodle](https://www.jdoodle.com/php-online-editor/)   
[extendsclass](https://extendsclass.com/php.html)   
[onlinegdb](https://www.onlinegdb.com/)   
[onecompiler](https://onecompiler.com/java)   
[awesome-online-ide](https://github.com/styfle/awesome-online-ide#full-ide)   


``` php
<?php
    $section = "regex";
    $sections = ['cheat sheet','functions', 'common'];

    $root = dirname(getcwd()).DIRECTORY_SEPARATOR."languages/docs/Basic/src";

    $languages = ['php', 'java', 'python', 'javascript', 'go'];

    $sectionPath= $root. DIRECTORY_SEPARATOR. $section;
    !is_dir($sectionPath) && mkdir($sectionPath);

    $result = array_map(function($value) use($sectionPath, $sections){
        $languagePath = $sectionPath. DIRECTORY_SEPARATOR. $value;
        !is_dir($languagePath) && mkdir($languagePath);

        $language = $languagePath.".mds";

        $partialContent = '';
        foreach($sections as $section){
            $partial = $languagePath. DIRECTORY_SEPARATOR. "$section.mds";
            $partialFilePath = explode("languages/docs/", $partial)[1];
            $str = "\n".str_pad("",8," ").'=== "'.ucfirst($section).'"'."\n".str_pad("",12," ");            
            $partialContent .= $str.'{'.'% include "'.$partialFilePath.'" %}'."\n";
            if(!file_exists($partial)){
                $str = "\n".str_pad("", 12," ").'=== "'.ucfirst($section).'"'."\n".str_pad("",16," ");
                $str .= "``` ${value}\n ".str_pad("",20," ")." ${value} \n".str_pad("",16," ")."```";
                file_put_contents($partial, $str);
            }
        }
        
        file_put_contents($language, $partialContent);

        $mainFilePath = explode("languages/docs/", $language)[1];
        $str = str_pad("",4," ").'=== "'.ucfirst($value).'"'."\n".str_pad("",8," ");
        return $str.'{'.'% include "'.$mainFilePath.'" %}'."\n";  

    }, $languages);

    $sectionRoot = dirname($root). DIRECTORY_SEPARATOR. ucwords($section).'.md';
    $sectionRootContent = '!!! data "'.ucwords($section).'"'."\n".implode("\n",$result);
    file_put_contents($sectionRoot, $sectionRootContent);    
```

## Window 2008 r2 install powershell
[powershell](https://docs.microsoft.com/en-us/powershell/scripting/windows-powershell/wmf/setup/install-configure?view=powershell-7.1)   
```
```