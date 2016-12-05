<?php

use PHPUnit\Framework\TestCase;
use Trimmer\Services\WordsTrimmer;


class WordsTrimmerTest extends TestCase
{
    public $testLength;
    public $testDelimiter;
    public $testText;

    public function setUp()
    {
        $this->testLength = 40;
        $this->testDelimiter = '[...]';
        $this->testText = "Far far away, behind the word mountains,
        far from the countries Vokalia and Consonantia, there live
        the blind texts. Separated they live in Bookmarksgrove right
        at the coast of the Semantics, a large language ocean.";
    }

    public function testTrim()
    {
        $trim = new WordsTrimmer($this->testText, $this->testLength, $this->testDelimiter);
        $outputShouldBe = "Far far away, behind the word[...]";

        $this->assertEquals($trim->trim(), $outputShouldBe);
    }
}
