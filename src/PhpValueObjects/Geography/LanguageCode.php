<?php

namespace PhpValueObjects\Geography;

use PhpValueObjects\AbstractStringValueObject;
use PhpValueObjects\Geography\Exception\InvalidLanguageCodeException;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Intl\Languages;
use TypeError;

abstract class LanguageCode extends AbstractStringValueObject
{
    /**
     * @param mixed $value
     *
     * @throws InvalidLanguageCodeException
     */
    protected function guard($value)
    {
        try {
            if (method_exists(Intl::class, 'getLanguageBundle')) {
                Intl::getLanguageBundle()->getLanguageName($value);
            } else {
                $languageName = Languages::getName($value);
            }
        } catch (MissingResourceException $e) {
            throw new InvalidLanguageCodeException($value);
        } catch (TypeError $e) {
            throw new InvalidLanguageCodeException($value);
        }

        if (null === $languageName) {
            throw new InvalidLanguageCodeException($value);
        }
    }
}
