<?php

namespace Bujhm\ExchangeRates\Api;

class CurrencyData
{
    public static function requestCurrencyData()
    {
        file_put_contents(__DIR__.'/log.txt', "\r\n \r\n".date("H:i:s")."\r\n".print_r(__CLASS__ . '::' . __FUNCTION__ . '();', true). "\r\n \r\n-------------------------", FILE_APPEND | LOCK_EX);
    }
}