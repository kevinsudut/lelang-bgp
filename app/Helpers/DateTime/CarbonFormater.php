<?php

namespace App\Helpers\DateTime;

use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Class CarbonFormater
 * @package App\Helpers\DateTime
 */
class CarbonFormater
{
    /**
     * @param string|null $carbon
     * @param string $format
     * @param bool $withLocalZone
     * @return string|string[]
     */
    public static function toGMT(
        string $carbon = null,
        string $format = 'D, M dS Y H:i:s',
        bool $withLocalZone = true
    ) {
        $carbon = $carbon ? Carbon::parse($carbon) : Carbon::now();
        if ($withLocalZone) {
            $carbon = $carbon->format("$format TO");
        } else {
            $carbon = $carbon->format($format);
        }
        return Str::replaceFirst('WIB', 'GMT', $carbon);
    }

    /**
     * @param string|null $carbon
     * @return string
     */
    public static function toMySql(string $carbon = null)
    {
        $carbon = $carbon ? Carbon::parse($carbon) : Carbon::now();
        return $carbon->format('Y-m-d H:i:s');
    }

    /**
     * @param bool $withSecond
     * @return string
     */
    public static function timestamp(bool $withSecond = false)
    {
        $format = 'Ymd Hi';
        if ($withSecond) {
            $format .= 's';
        }
        return Carbon::now()->format($format);
    }
}
