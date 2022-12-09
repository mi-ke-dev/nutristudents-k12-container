<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Exceptions;

final class CouldNotImportToCalendar extends \Exception
{
    /**
     * @return static
     */
    public static function startDayIsNotAMonday()
    {
        return new static('Calendar Start Day is not a Monday');
    }

}
