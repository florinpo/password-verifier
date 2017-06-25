<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 16:56
 */

namespace Verifier\Exceptions;


class CompositionCounterVerifierException extends VerifierException
{
    public static $templateMessage = '%s composition verifications should match the number of verifiers';

    public function getMainMessage()
    {
        return sprintf(static::$templateMessage, ucfirst($this->getfieldName()));
    }
}
