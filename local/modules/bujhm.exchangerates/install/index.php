<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class bujhm_exchangerates extends CModule
{
    public $MODULE_ID = 'bujhm.exchangerates';
    public $MODULE_GROUP_RIGHTS = 'Y';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;


    public function __construct()
    {
        $arModuleVersion = [];

        include __DIR__.'/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = Loc::getMessage('BUJHM_EXCHENGERATES_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('BUJHM_EXCHENGERATES_MODULE_DESCRIPTION');
    }

    public function DoInstall()
    {
        global $DB, $APPLICATION, $step;

        if (CheckVersion(ModuleManager::getVersion('main'), "14.00.00"))
        {
            $this->installDB();
            $this->InstallFiles();

            ModuleManager::registerModule($this->MODULE_ID);
        }
        else
        {
            $APPLICATION->ThrowException("Версия главного модуля ниже 14. Не поддерживается технология D7, необходимая модулю. Пожалуйста обновите систему.");
        }

        $APPLICATION->IncludeAdminFile(
            "Установка модуля - " . $this->MODULE_ID,
            __DIR__ . "/step.php"
        );

        return false;
    }

    public function installDB()
    {
        global $DB, $APPLICATION;

        // db
        $errors = $DB->runSQLBatch($_SERVER["DOCUMENT_ROOT"].'/local/modules/'.$this->MODULE_ID.'/install/db/mysql/install.sql');

        if ($errors !== false)
        {
            $APPLICATION->throwException(implode('', $errors));
            return false;
        }

        \CAgent::addAgent(
            'Bujhm\ExchangeRates\Agent::getCurrencyData();',
            $this->MODULE_ID,
            'N',
            84600,
            '',
            'Y',
            '05.02.2023 19:00:00'
        );

        return true;
    }
    public function UnInstallDB(){
        global $DB, $APPLICATION;
        $this->errors = false;

        $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"].'/local/modules/'.$this->MODULE_ID.'/install/db/mysql/uninstall.sql');

        if($this->errors !== false){
            $APPLICATION->ThrowException(implode("<br>", $this->errors));
            return false;
        }

        return true;
    }

    public function InstallFiles()
    {
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/local/modules/'.$this->MODULE_ID.'/install/components')){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == '..' || $item == '.')
                        continue;
                    CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/local/components/'.$item, $ReWrite = True, $Recursive = True);
                }
                closedir($dir);
            }
        }
        return true;
    }
    public function UnInstallFiles()
    {
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/local/modules/'.$this->MODULE_ID.'/install/components')){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
                        continue;

                    $dir0 = opendir($p0);
                    while (false !== $item0 = readdir($dir0))
                    {
                        if ($item0 == '..' || $item0 == '.')
                            continue;
                        DeleteDirFilesEx('/local/components/'.$item.'/'.$item0);
                    }
                    closedir($dir0);
                }
                closedir($dir);
            }
        }
        return true;
    }

    public function DoUninstall(){

        global $APPLICATION;

        $this->UnInstallDB();
        $this->UnInstallFiles();

        \CAgent::removeModuleAgents($this->MODULE_ID);

        UnRegisterModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile(
            "Деинсталляция модуля - ". $this->MODULE_ID,
            __DIR__."/unstep.php"
        );

        return false;
    }
}