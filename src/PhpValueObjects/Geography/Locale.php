<?php

namespace PhpValueObjects\Geography;

use PhpValueObjects\AbstractStringValueObject;
use PhpValueObjects\Geography\Exception\InvalidLocaleException;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Intl\Locales;
use TypeError;

abstract class Locale extends AbstractStringValueObject
{
    /**
     * @param mixed $value
     *
     * @throws InvalidLocaleException
     */
    protected function guard($value)
    {
        try {
            if (method_exists(Intl::class, 'getLocaleBundle')) {
                $localeName = Intl::getLocaleBundle()->getLocaleName($value);
            } else {
                $localeName = Locales::getName($value);
            }
        } catch (MissingResourceException $e) {
            throw new InvalidLocaleException($value);
        } catch (TypeError $e) {
            throw new InvalidLocaleException($value);
        }

        if (null === $localeName) {
            throw new InvalidLocaleException($value);
        }
    }
}
