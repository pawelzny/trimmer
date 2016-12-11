<?php

use PHPUnit\Framework\TestCase;
use Trimmer\Services\CharsTrimmer;
use Trimmer\Services\WordsTrimmer;
use Trimmer\Trim;

class TrimFacadeTest extends TestCase
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

    public function testTrimConstants()
    {
        $this->assertEquals('...', Trim::DEFAULT_DELIMITER);

        $this->assertEquals('...', Trim::ELLIPSIS);
        $this->assertEquals(PHP_EOL, Trim::EOL);
        $this->assertEquals("\t", Trim::TABULATOR);
        $this->assertEquals(' ', Trim::SPACE);
    }

    public function testTrimsChars()
    {
        $trim = Trim::chars($this->testText, $this->testLength, $this->testDelimiter);

        $this->assertInstanceOf(CharsTrimmer::class, $trim);
        $this->assertEquals('Far far away, behind the word mount[...]', $trim->trim());
    }

    public function testTrimsWords()
    {
        $trim = Trim::words($this->testText, $this->testLength, $this->testDelimiter);

        $this->assertInstanceOf(WordsTrimmer::class, $trim);
        $this->assertEquals('Far far away, behind the word[...]', $trim->trim());
    }
}
