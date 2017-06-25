<?php
/**
 * User: florinpo
 * Date: 22/06/2017
 * Time: 17:55
 */

namespace Verifier\Exceptions;


class GreaterThanVerifierException extends VerifierException
{
    public static $templateMessage = 'The length for %s should be greater than %u';

    public function getMainMessage()
    {
        return sprintf(static::$templateMessage, strtolower($this->getfieldName()), $this->getParams()['threshold']);
    }
}