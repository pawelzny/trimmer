# Trimmer

Trimmer provide support for straight trimming string to given length,
and also trimming with words aware. Will not cut word in half.

## Installation:

**If composer is installed globally in your OS:**
```
composer require pawelzny/trimmer
```

**If composer is installed localy in your project directory:**
```
php composer.phar require pawelzny/trimmer
```

## Get started

Use facade to access Trimmer objects or import proper class and use directly.


### Trim to characters length:

```php
<?PHP
use Trimmer\Trim;

$string = "Far far away, behind the word mountains,
          far from the countries Vokalia and Consonantia, there live
          the blind texts. Separated they live in Bookmarksgrove right
          at the coast of the Semantics, a large language ocean.";


$trim = Trim::chars($string, $length=40);

echo $trim->trim(); // Far far away, behind the word mountai...
```


### Trim to words length:

```php
<?PHP
use Trimmer\Trim;

$string = "Far far away, behind the word mountains,
          far from the countries Vokalia and Consonantia, there live
          the blind texts. Separated they live in Bookmarksgrove right
          at the coast of the Semantics, a large language ocean.";

$trim = Trim::words($string, $length=40);

echo $trim->trim(); // Far far away, behind the word...
```

# API

## Builds in constants:

```php
<?PHP
use Trimmer\Trim;

echo Trim::ELLIPSIS; // ...
echo Trim::EOL; // [end of line]
echo Trim::SPACE; // [white space]
echo Trim::TABULATOR; // [tab character]
echo Trim::DEFAULT_DELIMITER; // ...
```

## Facade:

### Trim::chars()

`CharsTrimmer: constructor(string: $string [, int: $length=null [, string: $delimiter=null]])`

### Trim::words()

`WordsTrimmer: constructor(string: $string [, int: $length=null [, string: $delimiter=null]])`

```php
<?PHP

use Trimmer\Trim;

$chars = Trim::chars($string, $length=30, $delimiter='');
$words = Trim::words($string, $length=30, $delimiter='');
```

## Methods:

### Trim
`string: trim()`

Performs trimming on string and return new trimmed string

```php
<?PHP

use Trimmer\Trim;

Trim::chars($string)->trim();
Trim::words($string)->trim();
```

### Set new length
`null: setLength(int: $length)`

**Caution!**: delimiter length will be automatically substracted from trimming length.

```php
<?PHP
use Trimmer\Trim;

$trim = Trim::chars($string);
$trim->setLength(30);
```

### Set Delimiter
`null: setDelimiter(string: $delimiter)`

```php
<?PHP
use Trimmer\Trimmer;

$trim = Trim::chars($string);
$trim->setDelimiter('[read more]');
```

### Without Facade

If you do not want to use facade you can create objects directly.

```php
<?PHP

use Trimmer\Services\WordsTrimmer;
use Trimmer\Services\CharsTrimmer;

$chars = new CharsTrimmer($string, $length, $delimiter);
$chars->setDelimiter($newDelimiter);
$chars->setLength($newLength);
$chars->trim();

$words = new WordsTrimmer($string, $length, $delimiter);
$words->setDelimiter($newDelimiter);
$words->setLength($newLength);
$words->trim();
```
