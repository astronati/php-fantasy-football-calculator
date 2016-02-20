[![Build Status](https://travis-ci.org/astronati/fantasy-football-calculator.svg?branch=master)](https://travis-ci.org/astronati/calculator)

# Fantasy Football Calculator
TODO

## Example
TODO

## Installation
TODO

## API Documentation
The documentation is generated using [phpDocumentor](http://www.phpdoc.org/) and you can find it in `docs/api`.
Please use the following command to run the documentation from the root path:
```sh
$ ./vendor/phpdocumentor/phpdocumentor/bin/phpdoc -d ./src -t ./docs/api
```

## Testing
Defines how to set up an environment to write, update and run all tests.

### Tests Suite Structure
The directories structure within the `tests` folder reflects what is inside the `src` folder:
```
src
\---->[folder-name]
\-------->[file-name].js
tests
\---->[folder-name]
\-------->[file-name].test.js
```

### Installation
The environment requires "[phpunit](https://phpunit.de/)", that has been already included in the `dev-dependencies` of
the `composer.json`.

#### Install all dependencies
To install all modules you just need to follow these steps:

- Go to the root path
- Run `$ composer install`

For example from here:
```sh
$ cd ../
$ composer install
```

## Running tests
Follow these steps to run the tests suite:

- Run `$ phpunit [tests-folder-path]`

For example from here:
```sh
$ ./vendor/phpunit/phpunit/phpunit ./tests
```

## License
This package is released under the [MIT license](LICENSE.md).
