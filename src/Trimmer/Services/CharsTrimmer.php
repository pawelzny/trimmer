<?php namespace Trimmer\Services;

use Trimmer\Contracts\Trimmable;


class CharsTrimmer extends Trimmer implements Trimmable
{
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
        return trim(substr($this->string, 0, $this->trim_length)) . $this->delimiter;
	}
}
