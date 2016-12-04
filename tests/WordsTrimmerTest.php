<?php
use PHPUnit\Framework\TestCase;
use Trimmer\Services\WordsTrimmer;

class WordsTrimmerTest extends TestCase
{
    public $testLength;
    public $testDelimiter;
    public $testText;

    public function setUp() {
        $this->testLength = 40;
        $this->testDelimiter = '[...]';
        $this->testText = "Far far away, behind the word mountains,
        far from the countries Vokalia and Consonantia, there live
        the blind texts. Separated they live in Bookmarksgrove right
        at the coast of the Semantics, a large language ocean.";
    }

    public function testStringAssignable()
    {
        // create new trimmer object with text, but  length and delimiter should be set to default
        $trim = new WordsTrimmer($this->testText);
        $class = new ReflectionClass($trim);

        $property = $class->getProperty('string');
        $property->setAccessible(true);
        $this->assertEquals($this->testText, $property->getValue($trim));
    }

    public function testLengthAssignable()
    {
        // create new trimmer object with text and length but delimiter should be set to default
        $trim = new WordsTrimmer($this->testText, $this->testLength);
        $class = new ReflectionClass($trim);

        $property = $class->getProperty('length');
        $property->setAccessible(true);
        $this->assertEquals($this->testLength, $property->getValue($trim));
    }

    public function testDelimiterAssignable()
    {
        // create new trimmer object with text, length and delimiter
        $trim = new WordsTrimmer($this->testText, $this->testLength, $this->testDelimiter);
        $class = new ReflectionClass($trim);

        $property = $class->getProperty('delimiter');
        $property->setAccessible(true);
        $this->assertEquals($this->testDelimiter, $property->getValue($trim));
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerLengthException
     */
    public function testNotNumberLengthThrowException()
    {
        // create new trimmer object with wrong length
        $trim = new WordsTrimmer($this->testText, $length='not a number'); // should throw exception
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerLengthException
     */
    public function testNegativeLengthThrowException()
    {
        // create new trimmer object with negative length
        $trim = new WordsTrimmer($this->testText, $length=-10); // should throw exception
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerLengthException
     */
    public function testNotIntegerLengthThrowException()
    {
        // create new trimmer object with negative length
        $trim = new WordsTrimmer($this->testText, $length=2.5); // should throw exception
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerStringException
     */
    public function testNotStringThrowException()
    {
        // create new trimmer object with negative length
        $trim = new WordsTrimmer(234234234); // should throw exception
    }

    public function testTrim()
    {
        $trim = new WordsTrimmer($this->testText, $this->testLength, $this->testDelimiter);
        $outputShouldBe = "Far far away, behind the word[...]";

        $this->assertEquals($trim->trim(), $outputShouldBe);
    }

    public function testSetNewDelimiter()
    {
        $trim = new WordsTrimmer($this->testText, $this->testLength, $delimiter='//');
        $class = new ReflectionClass($trim);

        $property = $class->getProperty('delimiter');
        $property->setAccessible(true);

        $newDelimiter = '/{...}/';
        $trim->setDelimiter($newDelimiter);

        // set new Delimiter
        $this->assertEquals($newDelimiter, $property->getValue($trim));
    }

    public function testSetNewLength()
    {
        // create new trimmer object
        $trim = new WordsTrimmer($this->testText, $this->testLength, $this->testDelimiter);
        $class = new ReflectionClass($trim);

        $property = $class->getProperty('trim_length');
        $property->setAccessible(true);

        $trimLengthShouldBe = $this->testLength - strlen($this->testDelimiter);

        // test length counted on construction init
        $this->assertEquals($trimLengthShouldBe, $property->getValue($trim));
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerLengthException
     */
    public function testSetNewLengthThrowException()
    {
        $trim = new WordsTrimmer($this->testText);
        $trim->setLength('not a number'); // should throw exception
    }
}
