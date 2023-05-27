<?php

namespace App\Service;

class CacheService
{
    public static function clearResponseCache()
    {
        \Spatie\ResponseCache\Facades\ResponseCache::clear();
    }
}
