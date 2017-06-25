<?php
/**
 * User: florinpo
 * Date: 22/06/2017
 * Time: 20:51
 */

namespace Verifier;

class NotNullVerifier extends AbstractVerifier
{
    public function check($input)
    {
        return $input !== NULL;
    }
}