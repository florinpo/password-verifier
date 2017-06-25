<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 15:15
 */

namespace Verifier\Exceptions;


class OneNumberVerifierException extends VerifierException
{
    public static $templateMessage = '%s should contain at least one number';

    public function getMainMessage()
    {
        return sprintf(static::$templateMessage, ucfirst($this->getfieldName()));
    }
}
