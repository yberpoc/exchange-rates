<?php

namespace Bujhm\ExchangeRates\Api;

class CurrencyData
{
    protected $path = __DIR__.'.data.xml';

    public static function requestCurrencyData()
    {
        $path = '/local/modules/lib/api/data.xml';
        $date = date('d/m/Y'); // Текущая дата
        /*$cache_time_out = 14400; // Время жизни кэша в секундах

        $file_currency_cache = './currency.xml'; // Файл кэша*/

//        if(!is_file($file_currency_cache) || filemtime($file_currency_cache) < (time() - $cache_time_out)) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$date);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $res = curl_exec($ch);
        curl_close($ch);

        file_put_contents($path, $res);

        //$arResult = self::xml2array($res);

        //file_put_contents(__DIR__.'/log.txt', "\r\n \r\n".date("H:i:s")."\r\n".print_r($arResult, true). "\r\n \r\n-------------------------", FILE_APPEND | LOCK_EX);
        
        $content_data = simplexml_load_file($path);
        $arResult = self::xml2array($content_data->xpath('Valute'));

        file_put_contents(__DIR__.'/log.txt', "\r\n \r\n".date("H:i:s")."\r\n".print_r($arResult, true). "\r\n \r\n-------------------------", FILE_APPEND | LOCK_EX);

        //return $content_currency->xpath('Valute');
    }

    private static function xml2array($xmlObject, $out = array ())
    {
        foreach ( (array) $xmlObject as $index => $node )
            $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

        return $out;
    }
}