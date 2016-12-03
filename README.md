[![Build Status](https://api.travis-ci.org/astronati/php-fantasy-football-calculator.svg?branch=master)](https://travis-ci.org/astronati/calculator)

# Fantasy Football Calculator
This library allows user to calculate the points that a team has reached after a soccer match. The total can be altered
through some bonus like the defense one.

## Installation
You can install the library and its dependencies using composer running:
```sh
$ composer require fantasy-football-calculator
```

## Documentation
The documentation is generated using [phpDocumentor](http://www.phpdoc.org/) and you can find it in
[docs/api](docs/api).

### Calculator
Run the following command to instantiate a calculator:
```php
$calculator = CalculatorFactory::create($quotations, $options);
```

#### getSum
**@param Array**  
**@return integer**  
```php
$total = $calculator->getSum($footballers);
```

#### getDefenseBonus
**@param Array**  
**@return integer**  
```php
$defenseBonus = $calculator->getDefenseBonus($footballers);
```

#### getFormationDetails
**@param Array**  
**@return Array**  
```php
$formationDetails = $calculator->getFormationDetails($footballers);
```

## Development
The environment requires [phpunit](https://phpunit.de/), that has been already included in the `dev-dependencies` of the
`composer.json`.

### Dependencies
To install all modules you just need to run following command from the root path:

```sh
$ composer install
```

### Documentation
Please use the following command to run the documentation from the root path:
```sh
$ ./vendor/bin/robo docs
```

### Testing
Tests are created next to related file as follows:
```
src
\-->[folder-name]
\---->[file-name].php
\---->[file-name]Test.php
```

Execute following command to run the tests suite from the root path:
```sh
$ ./vendor/bin/robo test
```

## License
This package is released under the [MIT license](LICENSE.md).
