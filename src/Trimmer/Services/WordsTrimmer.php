<?php namespace Trimmer\Services;

use Trimmer\Contracts\Trimmable;


class WordsTrimmer extends Trimmer implements Trimmable
{
    protected $split_pattern = '/([\s\n\r]+)/';

    /**
     * Trimmer constructor
     *
     * @param string $string String to trim.
     * @param int|null $length Optional length of trimmed string
     * @param string|null $delimiter Optional delimiter string
     */
	public function __construct($string, $length=null, $delimiter=null)
    {
        parent::__construct($string, $length, $delimiter);
	}

	/**
	 * Perform trimming on text
     *
     * @return string Trimmed string
     */
    public function trim()
    {
        $tokens = preg_split($this->split_pattern , $this->string, $limit=null, $flag=PREG_SPLIT_DELIM_CAPTURE);

        $text_parts = [];
        $tokens_length = 0;
        foreach ($tokens as $token) {
            $tokens_length += strlen($token);

            if ($tokens_length <= $this->trim_length) {
                array_push($text_parts, $token);
            } else {
                break;
            }
        }

        return trim(' '.join($text_parts)) . $this->delimiter;
	}
}
