<?php

namespace App\Helpers;

class DateTime
{
    public function convertFromSecondsToReadable($seconds)
    {
        $secs = $seconds % 60;
        $mins = floor(($seconds / 60) % 60);
        $hrs = floor($seconds / 3600);

        if ($secs > 0 && $mins == 0 && $hrs == 0) { // only seconds
            return $secs . ($secs > 1 ? 'seconds' : 'second');
        }

        if ($secs >= 0 && $mins > 0 && $hrs == 0) { // only seconds and minutes

            $time = $mins . ($mins > 1 ? 'minutes' : 'minute');

            if ($secs > 0) {
                $time .= ' ' . str_pad($secs, 2, '0', STR_PAD_LEFT) . ($secs > 1 ? 'seconds' : 'second');
            }

            return $time;;
        }

        if ($secs >= 0 && $mins >= 0 && $hrs > 0) { // seconds, minutes and hours

            $time = $hrs . ($hrs > 1 ? 'hours' : 'hour');

            if ($mins > 0) {
                $time .= ' ' . str_pad($mins, 2, '0') . ($mins > 1 ? 'minutes' : 'minute');
            }

            if ($secs > 0) {
                $time .= ' ' . str_pad($secs, 2, '0', STR_PAD_LEFT) . ($secs > 1 ? 'seconds' : 'second');
            }

            return $time;
        }

        return '0second';
    }

    public function convertFromMillisecondsToReadable(int $milliseconds)
    {
        return $this->convertFromSecondsToReadable($milliseconds / 1000);
    }
}
