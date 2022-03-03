<?php

namespace PhpValueObjects\Money;

use PhpValueObjects\AbstractStringValueObject;
use PhpValueObjects\Money\Exception\InvalidCurrencyException;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\Intl\Intl;
use TypeError;

abstract class Currency extends AbstractStringValueObject
{
    /**
     * @param string $value
     *
     * @throws InvalidCurrencyException
     */
    protected function guard($value)
    {
        try {
            if (method_exists(Intl::class, 'getCurrencyBundle')) {
                $currency = Currencies::getName($value);
            } else {
                $currency = Currencies::getName($value);
            }
        } catch (TypeError $e) {
            throw new InvalidCurrencyException($value);
        } catch (MissingResourceException $e) {
            throw new InvalidCurrencyException($value);
        }

        if (null === $currency) {
            throw new InvalidCurrencyException($value);
        }
    }
}
