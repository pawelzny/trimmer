<?php namespace Trimmer\Services;

use Trimmer\Contracts\Trimmable;


class WordsTrimmer extends Trimmer implements Trimmable
{
    /**
     * Token splitting pattern used to trim string with words aware.
     * Patter matches splitting by space and new line
     *
     * @var string
     */
    protected $split_pattern = '/([\t\s\n\r]+)/';

    /**
     * Perform string trimming
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
