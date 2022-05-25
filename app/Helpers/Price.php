<?php

namespace App\Helpers;

class Price
{
    public function getPriceInCentsWithDecimalsCount($value_in_decimals = 0): array
    {
        $decimals_count = strlen(substr(strrchr($value_in_decimals, "."), 1));

        $value_in_cents = $value_in_decimals * str_pad('1', $decimals_count + 1, '0', STR_PAD_RIGHT);

        return compact('value_in_cents', 'decimals_count');
    }

    public function getPriceInDecimals(int $value, int $decimals_count = 0): string
    {
        return number_format(($value / str_pad('1', $decimals_count + 1, '0', STR_PAD_RIGHT)), $decimals_count, '.', '');
    }
}
