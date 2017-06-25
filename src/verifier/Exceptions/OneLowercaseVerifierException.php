<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 13:51
 */

namespace Verifier\Exceptions;


class OneLowercaseVerifierException extends VerifierException
{
    public static $templateMessage = '%s should contain at least one lowercase character';

    public function getMainMessage()
    {
        return sprintf(static::$templateMessage, ucfirst($this->getfieldName()));
    }
}