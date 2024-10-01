<?php

namespace App\Services;

class TrackingCodeGenerator
{
    public static function generate()
    {
        // Format: TGLBLNTHN-JAMMENITDETIK-RANDOM5DIGIT
        $trackingCode = date('Ymd-His-') . mt_rand(10000, 99999);

        return $trackingCode;
    }
}
