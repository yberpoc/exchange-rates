<?php

namespace Bujhm\ExchangeRates;

use Bitrix\Main\Entity;

class Currency extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'exchange_rates';
    }

    public static function getUfId()
    {
        return 'EXCHANGE_RATES';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\StringField('CODE', array(
                'required' => true,
            )),
            new Entity\FloatField('COURSE'),
            new Entity\DateField('DATE'),
        );
    }
}