<?php
use PHPUnit\Framework\TestCase;
use Trimmer\Trimmer;

class TrimmerTest extends TestCase
{
    public $testLength;
    public $testDelimiter;
    public $testText;

    public function setUp() {
        $this->testLength = 10;
        $this->testDelimiter = '[...]';
        $this->testText = "Far far away, behind the word mountains,
        far from the countries Vokalia and Consonantia, there live
        the blind texts. Separated they live in Bookmarksgrove right
        at the coast of the Semantics, a large language ocean.";
    }

    public function testTextAsignable()
    {
        // create new trimmer object with text - length and delimiter should be set to default
        $trim = new Trimmer($this->testText);

        $this->assertEquals($trim->text, $this->testText);
        $this->assertEquals($trim->delimiter, '...');
        $this->assertEquals($trim->length, strlen($this->testText) - strlen($trim->delimiter));
    }

    public function testLengthAsignable()
    {
        // create new trimmer object with text, and length - delimiter should be set to default
        $trim = new Trimmer($this->testText, $this->testLength);

        $this->assertEquals($this->testText, $trim->text);
        $this->assertEquals($trim->delimiter, '...');
        $this->assertEquals($trim->length, $this->testLength - strlen($trim->delimiter));
    }

    public function testDelimiterAsignable()
    {
        // create new trimmer object with text, length, and delimiter
        $trim = new Trimmer($this->testText, $this->testLength, $this->testDelimiter);

        // check if all parameters have been assigned properly
        $this->assertEquals($this->testText, $trim->text);
        $this->assertEquals($trim->delimiter, $this->testDelimiter);
        $this->assertEquals($trim->length, $this->testLength - strlen($this->testDelimiter));
    }

    /**
     * @expectedException \Trimmer\TrimmerLengthException
     */
    public function testLengthThrowException()
    {
        // create new trimmer object with wrong length
        $trim = new Trimmer($this->testText, $length='not a number'); // should throw exception
    }

    public function testToWords()
    {
        // create new trimmer object
        $trim = new Trimmer($this->testText, $this->testLength);
        $outputShouldBe = 'Far far...';

        $this->assertEquals($trim->toWords(), $outputShouldBe);
    }

    public function testToCharacters()
    {
        // create new trimmer object
        $trim = new Trimmer($this->testText, $this->testLength, $this->testDelimiter);
        $outputShouldBe = "Far f[...]";

        $this->assertEquals($trim->toCharacters(), $outputShouldBe);
    }

    public function testSetDelimiter()
    {
        // create new trimmer object
        $trim = new Trimmer($this->testText, $this->testLength, $delimiter='//');
        $newDelimiter = '/{...}/';

        // test length counted on construction init
        $this->assertEquals($trim->length, $this->testLength - strlen($trim->delimiter));

        // set new Delimiter
        $trim->setDelimiter($newDelimiter);
        $this->assertEquals($trim->delimiter, $newDelimiter);
        $this->assertEquals($trim->length, $this->testLength - strlen($newDelimiter));
    }

    public function testSetLength()
    {
        // create new trimmer object
        $trim = new Trimmer($this->testText);
        $initLegthShouldBe = strlen($this->testText) - strlen($trim->delimiter);

        // test length counted on construction init
        $this->assertEquals($trim->length, $initLegthShouldBe);

        // set new length with setLength() method
        $trim->setLength($this->testLength);
        $this->assertEquals($trim->length, $this->testLength - strlen($trim->delimiter));

        // set length to null to go back to init state
        $trim->setLength($length=null);
        $this->assertEquals($trim->length, $initLegthShouldBe);
    }

    /**
     * @expectedException \Trimmer\TrimmerLengthException
     */
    public function testSetLengthThrowException()
    {
        $trim = new Trimmer($this->testText);
        $trim->setLength('not a number'); // should throw exception
    }

    public function testGetLengthWhenSet()
    {
        // create new trimmer object
        $trim = new Trimmer($this->testText, $this->testLength, $this->testDelimiter);

        // create new Reflection Class based on trimmer object
        $class = new \ReflectionClass($trim);
        $method = $class->getMethod('getLength'); // access protected method
        $method->setAccessible(true); // make it accesible as public

        $result = $method->invokeArgs($trim, $args=[]); // invoke protected method with argumets array
        $this->assertEquals($result, $trim->length);
    }

    public function testGetLengthWhenNull()
    {
        // create new trimmer object
        $trim = new Trimmer($this->testText, $length=null, $this->testDelimiter);

        // create new Reflection Class based on trimmer object
        $class = new \ReflectionClass($trim);
        $method = $class->getMethod('getLength'); // access protected method
        $method->setAccessible(true); // make it accesible as public

        $result = $method->invokeArgs($trim, $args=[]); // invoke protected method with argumets array
        $this->assertEquals($result, strlen($this->testText) - strlen($trim->delimiter));
    }
}
