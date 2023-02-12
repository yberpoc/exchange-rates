<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");

echo date('H:i:s');

function xml2array($xmlObject, $out = array ())
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}
function get_currency() {

    $date = date('d/m/Y'); // Текущая дата
    $cache_time_out = 14400; // Время жизни кэша в секундах

    $file_currency_cache = './currency.xml'; // Файл кэша

    if(!is_file($file_currency_cache) || filemtime($file_currency_cache) < (time() - $cache_time_out)) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$date);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $out = curl_exec($ch);

        curl_close($ch);

        file_put_contents($file_currency_cache, $out);
    }

    $content_currency = simplexml_load_file($file_currency_cache);

    return $content_currency->xpath('Valute');

}
$arCurrency = get_currency();

echo '<pre>';
print_r(xml2array($arCurrency));
echo '</pre>';


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>