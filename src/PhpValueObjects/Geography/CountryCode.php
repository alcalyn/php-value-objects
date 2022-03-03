<?php

namespace PhpValueObjects\Geography;

use PhpValueObjects\AbstractStringValueObject;
use PhpValueObjects\Geography\Exception\InvalidCountryCodeException;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\Intl\Intl;
use TypeError;

abstract class CountryCode extends AbstractStringValueObject
{
    /**
     * @param mixed $value
     *
     * @throws InvalidCountryCodeException
     */
    protected function guard($value)
    {
        try {
            if (method_exists(Intl::class, 'getRegionBundle')) {
                $countryName = Intl::getRegionBundle()->getCountryName($value);
            } else {
                $countryName = Countries::getName($value);
            }
        } catch (MissingResourceException $e) {
            throw new InvalidCountryCodeException($value);
        } catch (TypeError $e) {
            throw new InvalidCountryCodeException($value);
        }

        if (null === $countryName) {
            throw new InvalidCountryCodeException($value);
        }
    }
}
