<?php

namespace Bujhm\ExchangeRates\Api;

class CurrencyData
{
    public static function requestCurrencyData()
    {
        $path = __DIR__.'\data.xml';
        $date = date('d/m/Y'); // Текущая дата

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$date);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $res = curl_exec($ch);
        curl_close($ch);

        file_put_contents($path, $res);

        $content_data = simplexml_load_file($path);
        self::xml2array($content_data->xpath('Valute'));
    }

    private static function xml2array($xmlObject)
    {
        $out = [];
        foreach ( (array) $xmlObject as $index => $node )
            $out[$index] = ( is_object ( $node ) ) ? self::xml2array($node) : $node;

        file_put_contents(__DIR__.'/log.txt', "\r\n \r\n".date("H:i:s")."\r\n".print_r($out, true). "\r\n \r\n-------------------------", FILE_APPEND | LOCK_EX);
    }
}