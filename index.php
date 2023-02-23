<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Мебельная компания");

echo date('H:i:s');

/*function xml2array($xmlObject, $out = array ())
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
$arCurrency = get_currency();*/


/*class CurrencyData
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
        $out = array();
        foreach ( (array) $xmlObject as $index => $node )
            $out[$index] = ( is_object ( $node ) ) ? self::xml2array($node) : $node;

        file_put_contents(__DIR__.'/log.txt', "\r\n \r\n".date("H:i:s")."\r\n".print_r($out, true). "\r\n \r\n-------------------------", FILE_APPEND | LOCK_EX);
    }
}
CurrencyData::requestCurrencyData();*/


?>

<p>
Наша компания существует на Российском рынке с 1992 года. За это время «Мебельная компания» прошла большой путь от маленькой торговой фирмы до одного из крупнейших производителей корпусной мебели в России.
</p><p>
«Мебельная компания» осуществляет производство мебели на высококлассном оборудовании с применением минимальной доли ручного труда, что позволяет обеспечить высокое качество нашей продукции. Налажен производственный процесс как массового и индивидуального характера, что с одной стороны позволяет обеспечить постоянную номенклатуру изделий и индивидуальный подход – с другой.
<h3>Наша продукция</h3>
<?$APPLICATION->IncludeComponent("bitrix:furniture.catalog.index", "", array(
	"IBLOCK_TYPE" => "products",
	"IBLOCK_ID" => "2",
	"IBLOCK_BINDING" => "section",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "N"
	),
	false
);?>
<h3>Наши услуги</h3>
<?$APPLICATION->IncludeComponent("bitrix:furniture.catalog.index", "", array(
	"IBLOCK_TYPE" => "products",
	"IBLOCK_ID" => "3",
	"IBLOCK_BINDING" => "element",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "N"
	),
	false
);?>
</p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
