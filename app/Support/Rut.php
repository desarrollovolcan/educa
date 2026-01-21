<?php

declare(strict_types=1);

namespace GoEduca\Support;

final class Rut
{
    public static function normalize(string $rut): string
    {
        $rut = strtoupper(str_replace(['.', ' '], '', $rut));
        return $rut;
    }

    public static function isValid(string $rut): bool
    {
        $rut = self::normalize($rut);
        if (!preg_match('/^(\d{1,8})-([0-9K])$/', $rut, $matches)) {
            return false;
        }

        $number = $matches[1];
        $dv = $matches[2];
        $sum = 0;
        $multiplier = 2;

        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $sum += (int) $number[$i] * $multiplier;
            $multiplier = $multiplier === 7 ? 2 : $multiplier + 1;
        }

        $mod = 11 - ($sum % 11);
        $computed = $mod === 11 ? '0' : ($mod === 10 ? 'K' : (string) $mod);

        return $computed === $dv;
    }
}
