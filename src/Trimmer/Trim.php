<?php namespace Trimmer;

use Trimmer\Services\CharsTrimmer;
use Trimmer\Services\WordsTrimmer;

/**
 * Class Trim
 *
 * Simple facade for characters trimmer, and words trimmer classes
 *
 * @package Trimmer
 */
class Trim
{
    const ELLIPSIS = "...";
    const EOL = PHP_EOL;
    const TABULATOR = "\t";
    const SPACE = " ";

    const DEFAULT_DELIMITER = Trim::ELLIPSIS;

    private function __construct()
    {
    }

    /**
     * Simple facade method to create WordsTrimmer instance
     *
     * @param $string
     * @param null $length
     * @param null $delimiter
     * @return \Trimmer\Services\WordsTrimmer
     */
    public static function words($string, $length = null, $delimiter = null)
    {
        return new WordsTrimmer($string, $length, $delimiter);
    }

    /**
     * Simple facade method to create CharsTrimmer instance
     *
     * @param $string
     * @param null $length
     * @param null $delimiter
     * @return \Trimmer\Services\CharsTrimmer
     */
    public static function chars($string, $length = null, $delimiter = null)
    {
        return new CharsTrimmer($string, $length, $delimiter);
    }
}
