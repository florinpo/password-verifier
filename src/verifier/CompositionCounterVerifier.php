<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 15:36
 */

namespace Verifier;

use Verifier\Exceptions\VerifierException;

class CompositionCounterVerifier extends CompositionVerifier
{
    private $counter;

    public function __construct(array $verifiers, $counter = 0)
    {
        $this->verifiers = $verifiers;
        $this->counter = $counter;
    }

    public function check($input)
    {
        $validVerifiers = array_filter(
            $this->getVerifiers(),
            function($verifier) use ($input) {
                return $verifier->check($input);
            }
        );

        return count($validVerifiers) >= $this->counter;
    }
}
