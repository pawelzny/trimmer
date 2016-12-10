<?php namespace Trimmer\Services;

use Trimmer\Contracts\Trimmable;


class WordsTrimmer extends Trimmer implements Trimmable
{
    /**
     * Token splitting pattern used to split string into tokens.
     * Patter matches splitting by space, tab and new line.
     *
     * @var string
     */
    protected $tokenizer = " \t\n\r";

    /**
     * Perform string trimming
     *
     * @return string Trimmed string
     */
    public function trim()
    {
        $token = strtok($this->string, $this->tokenizer);
        $text = '';
        while ($token !== false) {
            if (strlen($text . ' ' . $token) <= $this->trim_length) {
                $text .= ' ' . $token;
                $token = strtok($this->tokenizer);
            } else {
                break;
            }
        }

        return trim($text) . $this->delimiter;
    }
}
