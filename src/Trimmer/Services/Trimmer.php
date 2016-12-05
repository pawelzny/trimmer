<?php namespace Trimmer\Services;

use Trimmer\Trim;
use Trimmer\Contracts\Trimmable;
use Trimmer\Exceptions\TrimmerDelimiterException;
use Trimmer\Exceptions\TrimmerLengthException;
use Trimmer\Exceptions\TrimmerStringException;


class Trimmer implements Trimmable
{
    protected $string = '';
    protected $length = null;
    protected $trim_length = null;
    protected $delimiter = Trim::DEFAULT_DELIMITER;

    /**
     * Trimmer constructor
     *
     * @param string $string String to trim.
     * @param int|null $length Optional length of trimmed string
     * @param string|null $delimiter Optional delimiter string
     *
     * @throws \Trimmer\Exceptions\TrimmerStringException
     */
	public function __construct($string, $length=null, $delimiter=null)
    {
        if (! is_string($string)) {
            throw new TrimmerStringException();
        }

        $this->string = $string;
		$this->setLength($length);
		$this->setDelimiter($delimiter);
	}

	/**
	 * Set new delimiter for trimmed string.
     *
     * @param string $delimiter
     * @return void
     *
     * @throws \Trimmer\Exceptions\TrimmerDelimiterException
     */
    public function setDelimiter($delimiter)
    {
        if ($delimiter === null) {
            $delimiter = Trim::DEFAULT_DELIMITER;
        }

        if (is_string($delimiter)) {
            $this->delimiter = $delimiter;
            $this->setLength($this->length);
        } else {
            throw new TrimmerDelimiterException();
        }
	}

	/**
     *
	 * Set new length of trimmed string.
     *
     * @param int $length
     * @return void
     *
     * @throws \Trimmer\Exceptions\TrimmerLengthException
     */
    public function setLength($length)
    {
        if ($length === null) {
            $length = strlen($this->string);
        }

        if (is_int($length) && $length >= 0) {
            $this->length = $length;
            $this->trim_length = $this->length - strlen($this->delimiter);
        } else {
			throw new TrimmerLengthException();
        }
	}

    /**
     * Perform string trimming
     *
     * @return string Trimmed string
     */
    function trim()
    {
        return trim($this->string) . $this->delimiter;
    }
}
