// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String
// https://jsbeginners.com/javascript-projects-for-beginners/
function get_class_methods() {}

// TODO 01. Assign an string to a variable
var string = 'Hello javascript!';
console.log(string);

// TODO 02. Literals/String
var string = 'Hello';
var template_literals = `
  ${string} world!
  "\n"
  '\n'
`;
console.log(template_literals);

// TODO 03. String interpolation (included)
var string = 'Hello';
console.log(`${string} world!`);

// TODO 04. Concatenating Strings
var string = 'Hello';
console.log(string + ' Javascript.');

// TODO 05. Empty string
var string = 'Hello Javascript.';
string = '';
console.log(string);

// TODO 06. Copy a string
var string = 'Hello Javascript.';
var copied_string = string;
console.log(copied_string);

// TODO 07. Replacing text within a string
var string = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum deleniti laudantium praesentium.';
console.log(string.replace('Lorem', 'Hello'));

// TODO 08. Make a string's first character lowercase
var string = 'lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto, sint.';
console.log(string.charAt(0).toUpperCase() + string.substr(1));

// TODO 09. Converting lowercase into Title Case
var string = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam, expedita non! Voluptates?';
console.log(
  string.replace(/\w\S*/g, function (txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  })
);

// TODO 10. Converting a whole string into UPPERCASE
var string = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto, sint.';
console.log(string.toUpperCase());

// TODO 11. Converting a whole String to lowercase
var string = 'LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT. CORPORIS, IURE.';
console.log(string.toLowerCase());

// TODO 12. Converting a string to an array
var string = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque, qui.';
const str_split = (string, length) => Array.from(Array(Math.ceil(string.length / length)), (_, i) => string.slice(i * length, i * length + length));
console.log(str_split(string, 3));

// TODO 13. Converting a number to ASCII code
console.log(String.fromCharCode(65));

// TODO 14. Converting an ASCII code to a number
console.log('AB'.charCodeAt(0));

// TODO 15. Removing white spaces from a String(Both head and tail)
var string = ' Lorem ipsum dolor sit amet consectetur. ';
console.log(string.trim());

// TODO 16. Strip whitespace (or other characters) from the beginning of a string
var greeting = '   Hello world!   ';
console.log(greeting.trimStart());

// TODO 17. Strip whitespace (or other characters) from the end of a string
var greeting = '   Hello world!   ';
console.log(greeting.trimEnd());

// TODO 18. Reversing a String
var string = 'Lorem ipsum dolor sit amet.';
console.log(string.split('').reverse().join(''));

// TODO 19. Reverse words in a string


// TODO 20. Calculate the md5 hash of a string
// TODO 21. Increment a numerical string
// TODO 22. Split a string into smaller chunks
// TODO 23. Split a string by a string
// TODO 24. Join array elements with a string
// TODO 25. Displaying part of String
var string = 'Lorem, ipsum dolor sit amet consectetur adipisicing.';
console.log(string.substr(5));

// TODO 26. Substring/Top and tail
// TODO 27. ellipsis
// TODO 28. Repeating a String
var string = '2034399002125581';
console.log(string.slice(-4).padStart(string.length, '*'));

// TODO 29. Format a number with grouped thousands
// TODO 30. Format the string with given format
// TODO 31. Parses input from a string according to a format
// TODO 32. Parse a CSV Comma-Separated Data string into an array
// TODO 33. Turning an Array into a Sentence
// TODO 34. Finding Text Within a String
var string = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore repellat ullam maiores temporibus odit perferendis?';
console.log(string.indexOf('elit'));

// TODO 35. Find the first occurrence of a character in a string
// TODO 36. Find the last occurrence of a character in a string
// TODO 37. Find the position of the last occurrence of a substring in a string
// TODO 38. Counting of the number of words in a String
var string = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, molestiae.';
console.log(string.split(' ').length);

// TODO 39. Count occurrences of a substring
// TODO 40. Return all characters used in a string
// TODO 41. Getting length of a String
var string = 'Lorem ipsum dolor sit amet.';
console.log(string.length);

// TODO 42. Comparing Strings
// TODO 43. Determine if a string is numeric
// TODO 44. Longest string challenge
