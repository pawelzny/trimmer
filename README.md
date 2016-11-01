# Trimmer

Helps with trimming long string to given length.
Trimmer supports trim to specific characters length with and without
rounding to whole word.

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

For Example if you have string: *"Helps with trimming long string"*,
and you want to trim it to 15 characters long. You have two options:


### Trim to characters length:

```php
<?PHP
use Trimmer\Trimmer;

$trim = new Trimmer('Helps with trimming long string', $length=15);
$trim->toCharacters(); // output: Helps with trim...
```


### Trim to words length:

```php
<?PHP
use Trimmer\Trimmer;

$trim = new Trimmer('Helps with trimming long string', $length=15);
$trim->toWords(); // output: Helps with...
```

As you can see, word "trimming" is to long so trimmer skip non fitting word.



# API

Supported API can be used on runtime.


## Build in delimiter constants:

```php
<?PHP
use Trimmer\Trimmer;

echo Trimmer::ELIPSIS; // ...
echo Trimmer::EOL; // [end of line]
echo Trimmer::SPACE; // [white space]
echo Trimmer::TABULATOR; // [tab character]
```


## Public properties:

```php
<?PHP
use Trimmer\Trimmer;

$trim = new Trimmer('Lorem ipsum', $length=5, $delimiter=Trimmer::ELIPSIS);

echo $trim->text; // Lorem ipsum
echo $trim->delimiter; // ...
echo $trim->length; // 5
```

## Exceptions:

### Trimmer Length Exception
`TrimmerLengthException('Length must be type of integer or null')`

This exception is throw always when length property is not type of Integer or Null.
You can catch this exception exclusively.

```php
<?PHP

use Trimmer\Trimmer;

try {
    $trim = new Trimmer('Lorem ipsum', $length='not an integer or null');
} catch (Trimmer\TrimmerLengthException) {
    die('something goes wrong');
}
```


## Methods:

### Create new Trimmer object
`Trimmer: constructor(string: $string [, int: $length=null [, string: $delimiter=self::ELIPSIS]])`

```php
<?PHP

use Trimmer\Trimmer;

$trim = new Trimmer('Lorem ipsum', $length=5, $delimiter=Trimmer::EOL);
```


### Set new length
`null: setLength(int: $length)`

**Caution!**: delimiter length will be automatically substracted from trimming length.

```php
<?PHP
use Trimmer\Trimmer;

$trim = new Trimmer('my funky string');
$trim->setLength(30);
echo $trim->length; // 27  (in this example: 30 - length_of_delimiter = 27)
```
Default delimiter is set to Trimmer::ELIPSIS which is 3 characters length.

### Set Delimiter
`null: setDelimiter(string: $delimiter)`

```php
<?PHP
use Trimmer\Trimmer;

$trim = new Trimmer('my funky string', $length=6);
$trim->setDelimiter('[read more]');
$trim->delimiter; // [read more]
```


### Trim to characters length
`string: toCharacters()`

```php
<?PHP
use Trimmer\Trimmer;

$trim = new Trimmer('my funky string', $length=6);
echo $trim->toCharacters(); // my fun...
```


### Trim to whole words
`string: toWords()`

```php
<?PHP
use Trimmer\Trimmer;

$trim = new Trimmer('my funky string', $length=11);
echo $trim->toWords(); // my funky...
```
