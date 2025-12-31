<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

class Make
{
    /**
     * Generate a slug from a string
     *
     * @param string $string
     * @param string $separator
     * @return string
     */
    public static function slug(string $string, string $separator = ''): string
    {
        $original = strtolower(trim($string));

        $hasUnderscore = str_contains($original, '_');
        $hasHyphen = str_contains($original, '-');

        // Allow only letters, numbers, underscores, and hyphens
        $clean = preg_replace('/[^a-z0-9\-_]+/', '', $original);

        if ($hasUnderscore && !$hasHyphen) {
            $clean = preg_replace('/_+/', '_', $clean);
            return trim($clean, '_');
        }

        if ($hasHyphen && !$hasUnderscore) {
            $clean = preg_replace('/-+/', '-', $clean);
            return trim($clean, '-');
        }

        if ($hasUnderscore && $hasHyphen) {
            $firstSeparator = strpos($original, '_') < strpos($original, '-') ? '_' : '-';
            $clean = preg_replace('/[\-_]+/', $firstSeparator, $clean);
            return trim($clean, $firstSeparator);
        }

        // No existing separators → use the given one
        if ($separator === '') {
            return preg_replace('/[^a-z0-9]+/', '', $clean);
        }

        $clean = preg_replace('/[^a-z0-9]+/', $separator, $clean);
        return trim($clean, $separator);
    }

    public static function random(int $length = 8, string $type = 'alphanumeric'): string
    {
        // Normalize type
        $type = strtolower($type);

        // Define character pools
        $numericPool = '0123456789';
        $alphaPool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $alphanumericPool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Select pool based on type
        switch ($type) {
            case 'numeric':
                $pool = $numericPool;
                break;
            case 'alpha':
                $pool = $alphaPool;
                break;
            case 'alphanumeric':
            default:
                $pool = $alphanumericPool;
                break;
        }

        $result = '';
        $poolLength = strlen($pool);

        for ($i = 0; $i < $length; $i++) {
            $result .= substr(str_shuffle($pool), 0, 1);
        }

        return $result;
    }

    public static function uniqueRandom(int $length = 8, string $type = 'numeric', string $column = 'id', string $table): string
    {
        $value = self::random($length, $type);

        while (DB::table($table)->where($column, $value)->exists()) {

            if ($type === 'numeric') {
                $value = (string)((int)$value + 1);
            } else {
                $value = self::random($length, $type);
            }
        }

        return $value;
    }

    public static function serialize(string $table, string $column, ?int $shopId = null, int $digits = 4): string
    {
        $query = DB::table($table);

        if (!empty($shopId)) {
            $query->where('shop_id', $shopId);
        }

        $lastValue = $query->max($column);
        $nextNumber = 1;

        if ($lastValue) {
            $nextNumber = (int)$lastValue + 1;
        }

        return str_pad($nextNumber, $digits, '0', STR_PAD_LEFT);
    }

    /**
     * Create a unique reference ID by combining Shop ID and Serial.
     * Example: 10-0001
     *
     * @param int    $shopId
     * @param string $serial The result from Make::serialize()
     * @param string $separator
     * @return string
     * EXAMPLE 
     * // 1. Generate the simple serial for the database
     *$shopId = 10;
     *$serial = Make::serialize('orders', 'serial_no', $shopId, 4); 
     * Result: "0001"

     *Save this 'serial' to your DB...

     * 2. Generate the "Reference" for URL or API
     *$reference = Make::makeReference($shopId, $serial);
     * Result: "10-0001"

     *Now you can use $reference safely
     * URL: /invoice/10-0001
     * Payment Gateway Invoice ID: INV-10-0001
     */
    public static function makeReference(int $shopId, string $serial, string $separator = '-'): string
    {
        return $shopId . $separator . $serial;
    }
}
