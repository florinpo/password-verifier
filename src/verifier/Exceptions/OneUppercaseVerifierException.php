<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 14:38
 */

namespace Verifier\Exceptions;

class OneUppercaseVerifierException extends VerifierException
{
    public static $templateMessage = '%s should contain at least one uppercase character';

    public function getMainMessage()
    {
        return sprintf(static::$templateMessage, ucfirst($this->getfieldName()));
    }
}
