# https://ruby-doc.org/core-2.7.1/String.html

# TODO assign an string to a variable

# TODO 1. Getting length of a String
string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, provident."
print string.length

# TODO 2. Counting of the number of words in a String
string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, libero?"
print string.split.size

# TODO 3. Reversing a String
string = "Lorem ipsum dolor sit amet."
print string.reverse

# TODO 4. Finding Text Within a String
string = "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit, natus!"
print string.index("sit")

# TODO 5. Replacing text within a string
string = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, consectetur."
print string.sub "Lorem", "Hello"

# TODO 6. Converting lowercase into Title Case
string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos dignissimos eum minima reiciendis deserunt quia!"
print string.split(" ").map {|word| word.capitalize}.join(" ")

# TODO 7. Converting a whole string into UPPERCASE
string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, officia."
print string.upcase

# TODO 8. Converting whole String to lowercase
string = "LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT. VOLUPTATEM, OFFICIA."
print string.downcase

# TODO 9. Repeating a String
string = "2034399002125581"
print ("*" * (string.length - 4 ))  + string.slice(-4..-1)

# TODO 10. Comparing Strings


# TODO 11. Displaying part of String
string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, magnam."
print string.slice(5..-1)

# TODO 12. Removing white spaces from a String
string = "   Lorem ipsum dolor sit amet consectetur adip "
print string.strip