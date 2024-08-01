<?php

namespace App\Service;

use DateTime;
use DateTimeZone;
use Exception;

class TimeCalculationService
{
    /**
     * @param string $date
     * @param string $timezone
     * @return string
     * @throws Exception
     */
    public function offsetMinutes(string $date, string $timezone): string
    {
        $datetime = new DateTime($date, new DateTimeZone($timezone));
        $diff = (new DateTime($date, new DateTimeZone('UTC')))->diff($datetime);

        return $diff->h * 60 + $diff->i;
    }

    /**
     * @param string $date
     * @return int
     * @throws Exception
     */
    public function februaryLength(string $date): int
    {
        $februaryDate = (new DateTime($date))->format('Y') . '-02-01';

        return (new DateTime($februaryDate))->format('t');
    }

    /**
     * @param string $date
     * @return string
     * @throws Exception
     */
    public function monthName(string $date): string
    {
        return (new DateTime($date))->format('F');
    }

    /**
     * @param string $date
     * @return int
     * @throws Exception
     */
    public function daysInMonth(string $date): int
    {
        return (new DateTime($date))->format('t');
    }
}