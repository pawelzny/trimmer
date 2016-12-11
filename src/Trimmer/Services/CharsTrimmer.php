<?php namespace Trimmer\Services;

use Trimmer\Contracts\Trimmable;

class CharsTrimmer extends Trimmer implements Trimmable
{
    /**
     * Perform string trimming
     *
     * @return string Trimmed string
     */
    public function trim()
    {
        return trim(substr($this->string, 0, $this->trim_length)) . $this->delimiter;
    }
}
