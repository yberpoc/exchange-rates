<?php
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if(!check_bitrix_sessid()){return;}

global $APPLICATION;

echo(CAdminMessage::ShowNote("Модуль удалён"));
?>

<form action="<? echo($APPLICATION->GetCurPage()); ?>">
    <input type="hidden" name="lang" value="<? echo(LANG); ?>" />
    <input type="submit" value="<? echo("Вернуться в список"); ?>">
</form>