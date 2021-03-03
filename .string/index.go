// https://golang.org/pkg/strings/
// https://gobyexample.com/
// https://gowebexamples.com/
// https://yourbasic.org/golang/
// https://golangbot.com/learn-golang-series/
// http://ws.audioscrobbler.com/2.0/?method=geo.gettoptracks&api_key=c1572082105bd40d247836b5c1819623&format=json&country=Netherlands

package main

import (
	"fmt"
	"strings"
)

func main() {
	// TODO assign an string to a variable
	string := " Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, sed. "
	fmt.Println(string)

	// TODO 1. Getting length of a String
	fmt.Println(len(string))

	// TODO 2. Counting of the number of words in a String
	fmt.Println(len(strings.Fields(string)))

	// TODO 3. Reversing a String
	fmt.Println(reverse(string))

	// TODO 4. Finding Text Within a String
	fmt.Println(strings.Index(string, "sit"))

	// TODO 5. Replacing text within a string
	fmt.Println(strings.Replace(string, "Lorem", "Hello", 1))

	// TODO 6. Converting lowercase into Title Case
	fmt.Println(strings.Title(string))

	// TODO 7. Converting a whole string into UPPERCASE
	fmt.Println(strings.ToUpper(string))

	// TODO 8. Converting whole String to lowercase
	fmt.Println(strings.ToLower(string))

	// TODO 9. Repeating a String
	number := "2034399002125581"
	fmt.Println(strings.Repeat("*", len(number)-4) + number[len(number)-4:])

	// TODO 10. Comparing Strings

	// TODO 11. Displaying part of String
	fmt.Println(string[5:])

	// TODO 12. Removing white spaces from a String
	fmt.Println(strings.Trim(string, " "))

}

func reverse(s string) string {
	runes := []rune(s)
	for i, j := 0, len(runes)-1; i < j; i, j = i+1, j-1 {
		runes[i], runes[j] = runes[j], runes[i]
	}
	return string(runes)
}
