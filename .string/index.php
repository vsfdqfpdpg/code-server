<?php
/* 
https://www.w3schools.com/php/php_ref_string.asp
https://www.php.net/manual/en/ref.strings.php
http://litindia.in/litsoftware/php/stringfunctions.pdf
http://litindia.in/litsoftware/php/arrayfunctions.pdf
[PHP](https://rosettacode.org/wiki/Category:PHP)
[PHP_Cookbook](https://freecomputerbooks.com/PHP_Cookbook.html)
*/

// Basic PHP String Functions 
// var_dump(get_defined_functions());
// var_dump(get_loaded_extensions());
// echo `ls`;
// var_dump(get_extension_funcs("swoole"));

// TODO 01. Assign an string to a variable
$string = "Hello world!";
echo $string;

// TODO 02. Literals/String
$string = "Lorem ipsum dolor sit amet";
$heredoc = <<<EOT
'$string'
"$string"
'\n'
"\n"
`ls`
EOT;
echo $heredoc;

// TODO 03. String interpolation (included)
$name = "PHP";
echo "Hello $name";

// TODO 04. Concatenating Strings
$name = "World!";
echo "Hello " . $name;

// TODO 05. Empty string
$name = "Hello";
$name = "";
echo $name;

// TODO 06. Copy a string
$message = "Hello world!";
$copy = $message;
echo $copy;

// TODO 07. Replacing text within a string
$string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. dolorem obcaecati ";
echo str_replace("Lorem", "Hello", $string);

// TODO 08. Make a string's first character lowercase
$string = "Lorem Ipsum Dolor Sit.";
echo lcfirst($string);

// TODO 09. Converting lowercase into Title Case
$string = "Lorem ipsum dolor sit.";
echo ucwords($string);

// TODO 10. Converting a whole string into UPPERCASE
$string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, dolorum!";
echo strtoupper($string);

// TODO 11. Converting a whole String to lowercase
$string = "LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT. PLACEAT, DOLORUM!";
echo strtolower($string);

// TODO 12. Converting a string to an array
$string = "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque, qui.";
var_dump(str_split($string, 3));

// TODO 13. Converting a number to ASCII code
echo chr(65);

// TODO 14. Converting an ASCII code to a number
echo ord("A");

// TODO 15. Removing white spaces from a String(Both head and tail)
$string = " Lorem ipsum dolor sit amet consectetur. ";
echo trim($string);

// TODO 16. Strip whitespace (or other characters) from the beginning of a string
$string = "!! lorem ipsum dolor sit amet, consectetur adip!";
echo ltrim($string, "!");

// TODO 17. Strip whitespace (or other characters) from the end of a string
$string = "!! lorem ipsum dolor sit amet, consectetur adip!";
echo rtrim($string, "!");

// TODO 18. Reversing a String
$string = "Lorem ipsum dolor sit amet.";
echo strrev($string);

// TODO 19. Reverse words in a string
$string = "Hey you, Bub! ";
echo implode(" ", array_reverse(explode(" ", $string)));

// TODO 20. Calculate the md5 hash of a string
$string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex";
echo md5($string);

// TODO 21. Increment a numerical string
$number_string = "6";
$number_string++;
echo $number_string;

// TODO 22. Split a string into smaller chunks
$string = "1234";
echo substr(chunk_split($string, 2, ":"), 0, -1);

// TODO 23. Split a string by a string
$string = "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus, saepe!";
var_dump(explode(" ", $string));

// TODO 24. Join array elements with a string
$array = ["Lorem", "ipsum", "dolor", "sit", "amet", "consectetur"];
$string = "Lorem ipsum dolor sit amet.";
echo implode(" ", $array) . $string;

// TODO 25. Displaying part of String
$string = "Lorem ipsum dolor sit amet.";
echo substr($string, 5);

// TODO 26. Substring/Top and tail
echo substr("brooms", 1, -1), "\n";

// TODO 27. ellipsis 
$string = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. quasi.";
echo substr($string, 0, 50) . '...';

// TODO 28. Repeating a String
$string = '2034399002125581';
echo str_pad(substr($string, -4), strlen($string), "*", STR_PAD_LEFT);

// TODO 29. Format a number with grouped thousands
$number = 1999999999999;
echo number_format($number);

// TODO 30. Format the string with given format
printf("%s %s", "Hello", date("Y-m-d H:i:s"));

// TODO 31. Parses input from a string according to a format
list($serial) = sscanf("SN/2350001", "SN/%d");
echo $serial;

// TODO 32. Parse a CSV Comma-Separated Data string into an array
$string = "Lorem, ipsum, dolor, sit, amet, consectetur, adipisicing, elit., Totam, iste?";
var_dump(str_getcsv($string));

// TODO 33. Turning an Array into a Sentence
$array = ["Lorem", "ipsum", "dolor", "sit", "amet", "consectetur"];
echo implode(" ", $array);

// TODO 34. Finding Text Within a String 
$string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet mollitia unde!";
echo strpos($string, "sit");

// TODO 35. Find the first occurrence of a character in a string
$string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, eveniet!";
echo strstr($string, "ip", true);

// TODO 36. Find the last occurrence of a character in a string
$string = "/www/public_html/index.html";
echo substr(strrchr($string, "/"), 1);

// TODO 37. Find the position of the last occurrence of a substring in a string
$string = "/www/public_html/index.html";
echo strrpos($string, "/");

// TODO 38. Counting of the number of words in a String
$string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum itaque mollitia, eum inventore las ea!";
echo str_word_count($string);

// TODO 39. Count occurrences of a substring
echo substr_count("the three truths", "th");

// TODO 40. Return all characters used in a string
$string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, labore.";
echo count_chars($string, 3);

// TODO 41. Getting length of a String
$string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, quo?";
echo strlen($string);

// TODO 42. Comparing Strings
// TODO 43. Determine if a string is numeric
$number_string = "777";
echo is_numeric($number_string);

// TODO 44. Longest string challenge