<?php

use PHPUnit\Framework\TestCase;
use Trimmer\Services\WordsTrimmer;
use Trimmer\Trim;


class WordsTrimmerTest extends TestCase
{
    public $testLength;
    public $testDelimiter;
    public $testText;

    public function setUp()
    {
        $this->testLength = 65;
        $this->testDelimiter = '[...]';
        $this->testText = "Far far away, behind the word mountains,
        far from the countries Vokalia and Consonantia, there live
        the blind texts. Separated they live in Bookmarksgrove right
        at the coast of the Semantics, a large language ocean.";
    }

    public function testTrim()
    {
        $trim = new WordsTrimmer($this->testText, $this->testLength, $this->testDelimiter);
        $expectedOutput = "Far far away, behind the word mountains, far from the[...]";

        $this->assertEquals($trim->trim(), $expectedOutput);
    }

    public function testEmptyStringTrim()
    {
        $trim = new WordsTrimmer('', $this->testLength);
        $this->assertEquals($trim->trim(), Trim::DEFAULT_DELIMITER);
    }

    public function testEmptyStringWithNewLine()
    {
        $trim = new WordsTrimmer("\n\r", $this->testLength);
        $this->assertEquals($trim->trim(), Trim::DEFAULT_DELIMITER);
    }
}
