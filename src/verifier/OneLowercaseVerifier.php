<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 13:45
 */

namespace Verifier;

class OneLowercaseVerifier extends AbstractVerifier
{
    public function check($input)
    {
        return (boolean) preg_match("/[a-z]+/", $input);
    }
}