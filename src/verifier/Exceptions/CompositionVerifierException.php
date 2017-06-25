<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 20:51
 */

namespace Verifier\Exceptions;


class CompositionVerifierException extends VerifierException
{
    public static $templateMessage = '%s verification failed';

    public function getMainMessage()
    {
        return sprintf(static::$templateMessage, ucfirst($this->getfieldName()));
    }
}
