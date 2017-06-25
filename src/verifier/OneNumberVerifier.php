<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 15:08
 */

namespace Verifier;

class OneNumberVerifier extends AbstractVerifier
{
    public function check($input)
    {
        return (boolean) preg_match("/[0-9]+/", $input);
    }
}
