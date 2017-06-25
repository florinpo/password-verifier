<?php
/**
 * User: florinpo
 * Date: 22/06/2017
 * Time: 21:14
 */

namespace Verifier\Exceptions;

class NotNullVerifierException extends VerifierException
{
    public static $templateMessage = '%s should not be null';

    public function getMainMessage()
    {
        return sprintf(static::$templateMessage, ucfirst($this->getfieldName()));
    }
}