<?php
use PHPUnit\Framework\TestCase;
use Trimmer\Services\CharsTrimmer;
use Trimmer\Services\WordsTrimmer;
use Trimmer\Trims;

class TrimsFacadeTest extends TestCase
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

    public function testTrimsChars()
    {
        $trims = Trims::chars($this->testText, $this->testLength, $this->testDelimiter);

        $this->assertInstanceOf(CharsTrimmer::class, $trims);
        $this->assertEquals('Far far away, behind the word mount[...]', $trims->trim());
    }

    public function testTrimsWords()
    {
        $trims = Trims::words($this->testText, $this->testLength, $this->testDelimiter);

        $this->assertInstanceOf(WordsTrimmer::class, $trims);
        $this->assertEquals('Far far away, behind the word[...]', $trims->trim());
    }
}
