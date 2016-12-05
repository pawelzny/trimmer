<?php
use PHPUnit\Framework\TestCase;
use Trimmer\Services\Trimmer;

class TrimmerTest extends TestCase
{
    public $testLength;
    public $testDelimiter;
    public $testText;

    public function setUp()
    {
        $this->testLength = 10;
        $this->testDelimiter = '[...]';
        $this->testText = "Far far away, behind the word mountains,
        far from the countries Vokalia and Consonantia, there live
        the blind texts. Separated they live in Bookmarksgrove right
        at the coast of the Semantics, a large language ocean.";
    }

    public function testConstructor()
    {
        $trimmer = new Trimmer($this->testText, $this->testLength, $this->testDelimiter);

        $this->assertInstanceOf(Trimmer::class, $trimmer);

        $class = new ReflectionClass($trimmer);

        $property = $class->getProperty('string');
        $property->setAccessible(true);
        $this->assertEquals($this->testText, $property->getValue($trimmer));

        $property = $class->getProperty('length');
        $property->setAccessible(true);
        $this->assertEquals($this->testLength, $property->getValue($trimmer));

        $property = $class->getProperty('trim_length');
        $property->setAccessible(true);
        $this->assertEquals($this->testLength - strlen($this->testDelimiter), $property->getValue($trimmer));

        $property = $class->getProperty('delimiter');
        $property->setAccessible(true);
        $this->assertEquals($this->testDelimiter, $property->getValue($trimmer));
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerLengthException
     */
    public function testNotNumberLengthThrowException()
    {
        // create new trimmer object with wrong length
        new Trimmer($this->testText, $length='not a number'); // should throw exception
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerLengthException
     */
    public function testNegativeLengthThrowException()
    {
        // create new trimmer object with negative length
        new Trimmer($this->testText, $length=-10); // should throw exception
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerLengthException
     */
    public function testNotIntegerLengthThrowException()
    {
        // create new trimmer object with negative length
        new Trimmer($this->testText, $length=2.5); // should throw exception
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerStringException
     */
    public function testNotStringThrowException()
    {
        // create new trimmer object with negative length
        new Trimmer(234234234); // should throw exception
    }

    public function testSetNewDelimiter()
    {
        $trimmer = new Trimmer($this->testText, $this->testLength, $delimiter='//');
        $class = new ReflectionClass($trimmer);

        $property = $class->getProperty('delimiter');
        $property->setAccessible(true);

        $newDelimiter = '/{...}/';
        $trimmer->setDelimiter($newDelimiter);

        // set new Delimiter
        $this->assertEquals($newDelimiter, $property->getValue($trimmer));
    }

    public function testSetNewLength()
    {
        // create new trimmer object
        $trimmer = new Trimmer($this->testText, $this->testLength, $this->testDelimiter);
        $class = new ReflectionClass($trimmer);

        $property = $class->getProperty('trim_length');
        $property->setAccessible(true);

        $trimLengthShouldBe = $this->testLength - strlen($this->testDelimiter);

        // test length counted on construction init
        $this->assertEquals($trimLengthShouldBe, $property->getValue($trimmer));
    }

    /**
     * @expectedException \Trimmer\Exceptions\TrimmerLengthException
     */
    public function testSetNewLengthThrowException()
    {
        $trimmer = new Trimmer($this->testText);
        $trimmer->setLength('not a number'); // should throw exception
    }
    
    public function testTrim()
    {
        $trimmer = new Trimmer($this->testText, $this->testLength, $this->testDelimiter);
        $this->assertEquals($this->testText . $this->testDelimiter, $trimmer->trim());
    }
}