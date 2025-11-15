<?php

namespace App\Support;

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
}
