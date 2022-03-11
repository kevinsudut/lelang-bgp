<?php

namespace App\Helpers\Image;

use App\Helpers\Cache\CacheManagement;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

/**
 * Class ConvertImage
 * @package App\Helpers\Image
 */
class ConvertImage
{
    /**
     * @param string $url
     * @return string|null
     */
    public static function toBase64(string $url)
    {
        try {
            return 'data:image/png;base64,' .
                base64_encode(File::get(storage_path("app/$url")));
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param string $url
     * @return mixed|string
     */
    public static function toBase64FromUrl(string $url)
    {
        try {
            $url = Cache::get($url);
            return 'data:image/png;base64,' . base64_encode(file_get_contents($url));
        } catch (Exception $e) {
            return asset('assets/no-profile.png');
        }
    }
}
