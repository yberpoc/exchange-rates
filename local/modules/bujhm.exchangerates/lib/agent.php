<?php

namespace Bujhm\ExchangeRates;

use Bujhm\ExchangeRates\Api;

class Agent
{
    public static function getCurrencyData()
    {
        Api\CurrencyData::requestCurrencyData();

        return __CLASS__ . '::' . __FUNCTION__ . '();';
    }
}
