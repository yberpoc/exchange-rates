<?php
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if(!check_bitrix_sessid()){return;}

global $APPLICATION;

if($errorException = $APPLICATION->GetException()){

    echo(CAdminMessage::ShowMessage($errorException->GetString()));
}else{

    echo(CAdminMessage::ShowNote("Модуль установлен"));
}
?>

<form action="<? echo($APPLICATION->GetCurPage()); ?>">
    <input type="hidden" name="lang" value="<? echo(LANG); ?>" />
    <input type="submit" value="<? echo("Вернуться в список"); ?>">
</form>