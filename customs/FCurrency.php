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
}
