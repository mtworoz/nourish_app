<?php

namespace App\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TimeConversionExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('convert_time', [$this, 'convertTime']),
        ];
    }

    public function convertTime($minutes)
    {
        $hours = floor($minutes / 60);
        $minutes %= 60;

        return ($hours ? "$hours h " : "") . ($minutes ? "$minutes min" : "");
    }
}
