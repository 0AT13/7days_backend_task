<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class TimeData
{
    /**
     * @Assert\DateTime(format="Y-m-d")
     * @Assert\NotBlank()
     */
    private string $date;

    /**
     * @Assert\Timezone()
     * @Assert\NotBlank()
     */
    private string $timezone;

    public function setDate(string $date): TimeData
    {
        $this->date = $date;

        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setTimezone(string $timezone): TimeData
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }
}