<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 14:36
 */

namespace Verifier;

class OneUppercaseVerifier extends AbstractVerifier
{
    public function check($input)
    {
        return (boolean) preg_match("/[A-Z]+/", $input);
    }
}
