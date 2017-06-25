<?php
/**
 * User: florinpo
 * Date: 21/06/2017
 * Time: 18:15
 */

namespace Verifier;

class GreaterThanVerifier extends AbstractVerifier
{
    public $threshold;

    public function __construct($threshold = 0)
    {
        $this->threshold = $threshold;
    }

    public function check($input)
    {
        return strlen($input) > $this->threshold;
    }
}
