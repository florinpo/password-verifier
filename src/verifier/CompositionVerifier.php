<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 20:46
 */

namespace Verifier;

class CompositionVerifier extends AbstractVerifier
{
    protected $verifiers;

    public function __construct(array $verifiers)
    {
        $this->verifiers = $verifiers;
    }

    public function getVerifiers()
    {
        return $this->verifiers;
    }

    public function check($input)
    {
        foreach ($this->verifiers as $verifier) {
            if (!$verifier->check($input)) {
                return false;
            }
        }

        return true;
    }

    public function verify($input)
    {
        if (!$this->check($input)) {
            foreach ($this->getVerifiers() as $v) {
                try {
                    $v->verify($input);
                } catch (VerifierException $e) {
                    throw $e;
                }
            }
        }

        return true;
    }
}
