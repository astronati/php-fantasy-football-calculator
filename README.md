[![Build Status](https://api.travis-ci.org/astronati/php-fantasy-football-calculator.svg?branch=master)](https://travis-ci.org/astronati/calculator)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/43c132465684468cab8c1f9df367952d)](https://www.codacy.com/app/astronati/php-fantasy-football-calculator?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=astronati/php-fantasy-football-calculator&amp;utm_campaign=Badge_Coverage)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/43c132465684468cab8c1f9df367952d)](https://www.codacy.com/app/astronati/php-fantasy-football-calculator?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=astronati/php-fantasy-football-calculator&amp;utm_campaign=Badge_Grade)
[![Dependency Status](https://www.versioneye.com/user/projects/58442e61b1c38c0a5d2b7e21/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/58442e61b1c38c0a5d2b7e21)
[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](./LICENSE.md)

# Fantasy Football Calculator
This library allows user to calculate the points that a team has reached after a soccer match. The total can be altered
through some bonus like the defense one.

## Installation
You can install the library and its dependencies using `composer` running:
```sh
$ composer require fantasy-football-calculator
```

### Usage
The library returns a result:

- A [MatchResult](https://github.com/astronati/php-fantasy-football-calculator/blob/master/src/Calculator/Result/MatchResult.php)
when a fantasyteam is against another one
- A simple [Result](https://github.com/astronati/php-fantasy-football-calculator/blob/master/src/Calculator/Result/Result.php)
when a fantasyteam plays against all others

#### Rules
Calculator can be configured with different rules in order to apply different bonus/malus to the final result.
Rules can be applied to a single team or in a match context: take a look at following folders to see which bonus are supported:

- [Match Rules](https://github.com/astronati/php-fantasy-football-calculator/blob/master/src/Calculator/Configuration/Rule/Match)
- [Team Rules](https://github.com/astronati/php-fantasy-football-calculator/blob/master/src/Calculator/Configuration/Rule/Team)

Each rule can be added to the Calculator configuration as shown in the example as follows.

**NOTE:**
To request another rule please file a new [issue](https://github.com/astronati/php-fantasy-football-calculator/issues/new).

#### Formation and Footballers
Calculator needs one or two formations: so developer has to provide [Formation](https://github.com/astronati/php-fantasy-football-calculator/blob/master/src/Formation/Formation.php)
instances.

```php
// Prepare formation
$formation = new Formation();
$formation->addFirstString(new Footballer())...
```

**NOTE**
Footballer abstract class needs to be extended by developer that has to set the *code* property.
The *code* property is the one provided by the [Quotation(s)](https://github.com/astronati/php-fantasy-football-quotations-parser/blob/master/src/Model/QuotationInterface.php)
instances.

Take a look at the [Footballer](https://github.com/astronati/php-fantasy-football-calculator/blob/master/example/Footballer.php)
class that has been implemented in the example folder.

#### Example
A couple of examples are provided in order to figure out better how this library can be integrated in the own system.

```php
// Configure calculator
$configuration = new Configuration();
$configuration
  ->addRule(RuleFactory::create(RuleFactory::BEST_DEFENDERS_RULE))
  ->addRule(RuleFactory::create(RuleFactory::HOME_RULE))
;
$calculator = new Calculator($quotations, $configuration);
```

##### Match Result
The following snippet is extracted from the
[example/sample.php](https://github.com/astronati/php-fantasy-football-calculator/blob/master/example/sampleMatch.php)
file and shows how configuring a calculator in a match.

```php
// Show match results...
$matchResult = $calculator->getMatchResult($formationA, $formationB);
$homeResult = $matchResult->getHomeResult();
echo '(' . $homeResult->getMagicPoints() . ' ' . $homeResult->getBonus() . ') '. $matchResult->getHomeGoals();
```

##### Result
The following snippet is extracted from the
[example/sample.php](https://github.com/astronati/php-fantasy-football-calculator/blob/master/example/sample.php)
file and shows how configuring a calculator when a fantasyteam plays alone or against all others.

```php
// Show single result...
$singleResult = $calculator->getSingleResult($formation);
echo $singleResult->getMagicPoints() . ' ' . $singleResult->getBonus();
```

## Development
The environment requires [phpunit](https://phpunit.de/), that has been already included in the `dev-dependencies` of the
`composer.json`.

### Dependencies
To install all modules you just need to run following command:

```sh
$ composer install
```

### Testing
Tests files are created in dedicates folders that replicate the
[src](https://github.com/astronati/php-fantasy-football-calculator/tree/master/src) structure as follows:
```
.
+-- src
|   +-- [folder-name]
|   |   +-- [file-name].php
|   ...
+-- tests
|   +-- [folder-name]
|   |   +-- [file-name]Test.php
```

Execute following command to run the tests suite:
```sh
$ composer test
```

Run what follows to see the code coverage:
```sh
$ composer coverage
```

## License
This package is released under the [MIT license](LICENSE.md).
