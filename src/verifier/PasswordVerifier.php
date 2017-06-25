<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 21:19
 */

namespace Verifier;

class PasswordVerifier extends AbstractVerifier
{
    private $counter;
    private $treshhold;
    private $verification;

    public function __construct($counter, $treshhold)
    {
        $this->counter = $counter;
        $this->treshhold = $treshhold;
        $this->buildVerification();
    }

    public function buildVerification()
    {
        $verification = new CompositionVerifier(
            array(
                new OneLowercaseVerifier(),
                new CompositionCounterVerifier(
                    array(
                        new NotNullVerifier(),
                        new GreaterThanVerifier($this->treshhold),
                        new OneNumberVerifier(),
                        new OneLowercaseVerifier(),
                        new OneUppercaseVerifier()
                    ),
                    $this->counter
                )
            )
        );

        $this->verification = $verification;
    }

    public function getVerification()
    {
        return $this->verification;
    }

    public function check($input)
    {
        if ($this->getVerification()->check($input)) {
            return true;
        }

        return false;
    }

    public function verify($input)
    {
        if (!$this->check($input)) {
            $this->getVerification()->verify($input);
        }

        return true;
    }
}
