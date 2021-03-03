'''
https:#docs.python.org/3/library/stdtypes.html#string-methods
'''

# TODO assign an string to a variable


# TODO 1. Getting length of a String
string = "Lorem ipsum dolor sit amet."
print(len(string))

# TODO 2. Counting of the number of words in a String
string = "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut, voluptate?"
print(len(string.split()))

# TODO 3. Reversing a String
string = "Lorem ipsum dolor sit amet."
print(string[::-1])
print("".join(reversed(string)))

# TODO 4. Finding Text Within a String
string = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, ipsum!"
print(string.index("sit"))

# TODO 5. Replacing text within a string
string = "Lorem ipsum dolor sit amet consectetur adipisicing."
print(string.replace("Lorem", "Hello"))

# TODO 6. Converting lowercase into Title Case
string = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias?"
print(string.title())

# TODO 7. Converting a whole string into UPPERCASE
string = "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus!"
print(string.upper())

# TODO 8. Converting whole String to lowercase
string = "LOREM IPSUM DOLOR SIT, AMET CONSECTETUR ADIPISICING ELIT. MINUS!"
print(string.lower())

# TODO 9. Repeating a String
string = '2034399002125581'
print(string[-4:].rjust(len(string), "*"))

# TODO 10. Comparing Strings

# TODO 11. Displaying part of String
string = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, eveniet!"
print(string[5:])

# TODO 12. Removing white spaces from a String
string = " Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex, animi. "
print(string.strip())
