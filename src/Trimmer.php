<?php namespace Trimmer;

class TrimmerLengthException extends \InvalidArgumentException {}

class Trimmer
{
    const ELIPSIS = "...";
    const EOL = PHP_EOL;
    const TABULATOR = "\t";
    const SPACE = " ";

	public $text = '';
	public $length;
	public $delimiter;

	protected $split_pattern = '/([\s\n\r]+)/';

    /**
     * Timer constructor
     *
     * @param (string) $text String to trim.
     * @param [int|null] $length Optional length of trimmed string
     * @param [string] $delimiter Optional delimiter string
     */
	public function __construct($text, $length=null, $delimiter=self::ELIPSIS)
    {
		$this->text = $text;
		$this->delimiter = $delimiter;
		$this->setLength($length);
	}

	/**
	 * Returns trimmed string to given character number precision, rounded to whole words.
     *
     * @return (string) Trimmed string
     */
    public function toWords()
    {
        $tokens = preg_split($this->split_pattern , $this->text, $limit=null, $flag=PREG_SPLIT_DELIM_CAPTURE);

        $text_parts = [];
        $tokens_length = 0;
        foreach ($tokens as $token) {
            $tokens_length += strlen($token);

            if ($tokens_length <= $this->getLength()) {
                array_push($text_parts, $token);
            } else {
                break;
            }
        }

        return trim(' '.join($text_parts)) . $this->delimiter;
    }

	/**
	 * Returns trimmed string to given character number precision.
     *
     * @return (string) Trimmed string
     */
    public function toCharacters()
    {
		return trim(substr($this->text, 0, $this->getLength())) . $this->delimiter;
	}

	/**
	 * Set new delimiter for trimmed string.
     *
     * @param (string) $delimiter
     */
    public function setDelimiter($delimiter)
    {
		$oldDelimiter = $this->delimiter;

		$this->delimiter = $delimiter;
		$this->setLength($this->length + strlen($oldDelimiter));
	}

	/**
     *
	 * Set new length of trimmed string.
     * @param int|null $length
     * @throws \Trimmer\TrimmerLengthException
     */
    public function setLength($length)
    {
		if (! is_numeric($length) and ! is_null($length)) {
			throw new TrimmerLengthException('Length must be type of integer or null');
		}

        $this->length = ((is_null($length))
            ? strlen($this->text)
            : $length)
            - strlen($this->delimiter);
	}

	/**
	 * Count current length for trimmed string included delimiter length.
     *
     * @return int Length of trimmed string.
     */
    protected function getLength()
    {
        return ($this->length === null)
            ? strlen($this->text)
            : $this->length;
	}
}
