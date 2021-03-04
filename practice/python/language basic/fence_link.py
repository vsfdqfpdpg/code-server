import markdown
from markdown_language_tools.fence_link import FenceLinkExtension

string = """ !!! data "Data Types"
    === "PHP"
        === "String"
            ``` php
            <?php
                $expand = "apple";
                // [single](https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.single)
                echo 'this is a simple single quote string'.PHP_EOL;
                echo 'Variables do not $expand'.PHP_EOL;

                echo "He drank some $expand juice.".PHP_EOL;

                $hereDoc = <<<EOF
                    HereDoc syntax will output string as it original content and
                also will parse variables like '$expand' variable;
                EOF;
                echo $hereDoc.PHP_EOL;

                $nowDoc = <<<'EOT'
                    NowDoc is similar to hereDoc but not parse variables like '$expand'
                EOT;
                echo $nowDoc.PHP_EOL;
            ```
        === "Integer"
            Integer 
             
        === "Boolean"
            Boolean 

        ===  "Array"
            Array 
        
        ===  "Object"
            Object 

        ===  "NULL"
            NULL 

        ===  "Float"
            Float
             
        ===  "Resource"
            Resource

        === "Iterable"
            Iterable

        ===  "Callback / Callable"
            Callback / Callable
        

    
    --foo bar--

"""
print(markdown.markdown(string, extensions=[FenceLinkExtension()]))