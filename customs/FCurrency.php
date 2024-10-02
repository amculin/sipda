<?php
namespace app\customs;

trait FCurrency
{
    const RUPIAH = 'Rp';

    public function toRupiah($nominal, $useSymbol = false)
    {
        $symbol = ($useSymbol ? $this::RUPIAH . ' ' : '');

        return $symbol . number_format($nominal, 0, ",", ".");
    }

    public function toShort($nominal)
    {
        $nominal = (int) $nominal;
        $shortNumber = 0;
        $symbol = '';

        if ($nominal > 1000000000000) {
            $shortNumber = round(($nominal / 1000000000000), 2);
            $symbol = ' T';
        } elseif ($nominal > 1000000000) {
            $shortNumber = round(($nominal / 1000000000), 2);
            $symbol = ' M';
        } elseif ($nominal > 1000000) {
            $shortNumber = round(($nominal / 1000000), 2);
            $symbol = ' jt';
        } elseif ($nominal > 1000) {
            $shortNumber = round(($nominal / 1000), 2);
            $symbol = ' rb';
        }

        return number_format($shortNumber, 1, ',', '.') . $symbol;
    }
}
