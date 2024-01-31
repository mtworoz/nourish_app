<?php

namespace App\Application\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TimeConversionExtension extends AbstractExtension
{
    public function getFilters() : array
    {
        return [
            new TwigFilter('convert_time', [$this, 'convertTime']),
        ];
    }

    public function convertTime($minutes) : string
    {
        $hours = floor($minutes / 60);
        $minutes %= 60;

        return ($hours ? "$hours h " : "") . ($minutes ? "$minutes min" : "");
    }
}
