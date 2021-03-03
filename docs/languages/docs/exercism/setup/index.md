=== "Javascript"
    1. Download <br> ` $ exercism download --exercise=hello-world --track=javascript `
    2. package.json <br> 
    ``` {.json data-play="false"}
    {
    "name": "@exercism/javascript",
    "description": "Exercism exercises in Javascript.",
    "author": "Katrina Owen",
    "private": true,
    "repository": {
        "type": "git",
        "url": "https://github.com/exercism/javascript"
    },
    "devDependencies": {
        "@babel/cli": "^7.12.10",
        "@babel/core": "^7.12.10",
        "@babel/plugin-syntax-bigint": "^7.8.3",
        "@babel/preset-env": "^7.12.11",
        "@types/jest": "^26.0.19",
        "@types/node": "^14.14.14",
        "babel-eslint": "^10.1.0",
        "babel-jest": "^26.6.3",
        "core-js": "^3.8.1",
        "eslint": "^7.15.0",
        "eslint-plugin-import": "^2.22.1",
        "jest": "^26.6.3"
    },
    "jest": {
        "modulePathIgnorePatterns": [
        "package.json"
        ]
    },
    "scripts": {
        "test": "jest --no-cache ./*",
        "watch": "jest --no-cache --watch ./*",
        "lint": "eslint ."
    },
    "license": "MIT",
    "dependencies": {},
    "version": "1.1.0"
    }
    ```
    babel.config.js <br>
    ``` {.javascript data-play="false"} 
    module.exports = {
        presets: [
            [
            '@babel/preset-env',
            {
                targets: {
                node: 'current',
                },
                useBuiltIns: 'entry',
                corejs: 3,
            },
            ],
        ],
        plugins: ['@babel/plugin-syntax-bigint'],
    };
    ```
    1. Install dependencies <br> ` $  npm install`
    2. Running test <br> ` $ npm test `
=== "PHP"
    1. Install phpunit globally <br>  ` $ composer global require phpunit/phpunit `
    2. Test filename should be as same as test class name
    3. Download <br> ` $ exercism download --exercise=hello-world --track=php `
    4. Running test <br> ` $ phpunit HelloWorldTest.php `

=== "Python"
    1. If pytest installed then uninstall it <br>  ` $ pip uninstall pytest `
    2. Find python installation directory <br> ` $ python -c "import os, sys; print(os.path.join(os.path.dirname(sys.executable),'Scripts'))" `
    3. Cd to Scripts directory <br> ` $ cd /d C:\Python39\Scripts `
    4. Install pytest <br> ` $ pip install -U pytest `
    5. Download <br> ` $ exercism download --exercise=hello-world --track=python `
    6. Running test <br> ` $ pytest hello_world_test.py `

=== "Java"
    1. [Install gradle](https://exercism.io/tracks/java/installation)
    2. Download <br> ` $ exercism download --exercise=hello-world --track=java `
    3. Running test <br> ` $ gradle test `

=== "Ruby"
    1. Install minitest. <br> ` $ gem install minitest `
    2. Download <br> ` $ exercism download --exercise=hello-world --track=ruby `
    3. Running test <br> ` $ ruby -r minitest/pride hello_world_test.rb `

=== "Go"
    1. Download <br> ` $ exercism download --exercise=hello-world --track=go `
    2.  Running test <br> ` $ go test `


``` {.css data-play="false"}
// select li which doesn't have a 'class' attribute...
console.log(document.querySelector("li:not([class])"))

// select li which doesn't have a '.completed' and a '.selected' class...
console.log(document.querySelector("li:not(.completed):not(.selected)"))
```



???+ tip "Example"
    === "Unordered List"

        _Example_:

        ``` markdown
        * Sed sagittis eleifend rutrum
        * Donec vitae suscipit est
        * Nulla tempor lobortis orci
        ```

        _Result_:

        * Sed sagittis eleifend rutrum
        * Donec vitae suscipit est
        * Nulla tempor lobortis orci

    === "Ordered List"

        _Example_:

        ``` markdown
        1. Sed sagittis eleifend rutrum
        2. Donec vitae suscipit est
        3. Nulla tempor lobortis orci
        ```

        _Result_:

        1. Sed sagittis eleifend rutrum
        2. Donec vitae suscipit est
        3. Nulla tempor lobortis orci

