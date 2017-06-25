<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 15:34
 */

namespace Verifier;

class CompositionCounterVerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidCompositionCounterVerifiers
     */
    public function testValidVerifiersMatchingTheCounterShouldReturnTrue($string, $counter, $verifiers)
    {
        $verifier = new CompositionCounterVerifier($verifiers, $counter);
        $this->assertTrue($verifier->check($string));
        $this->assertTrue($verifier->verify($string));
    }

    /**
     * @dataProvider providerForInvalidCompositionCounterVerifiers
     */
    public function testInvalidVerifiersNotMatchingTheCounterShouldReturnFalse($string, $counter, $verifiers)
    {
        $verifier = new CompositionCounterVerifier($verifiers, $counter);
        $this->assertFalse($verifier->check($string));
    }

    /**
     * @expectedException \Verifier\Exceptions\GreaterThanVerifierException
     */
    public function testInvalidFirstVerifierShouldThrowItsException()
    {
        $verifier = new CompositionCounterVerifier(
            array(
                new GreaterThanVerifier(8),
                new NotNullVerifier(),
                new OneNumberVerifier(),
            ),
            3
        );

        $verifier->verify('test1');
    }

    public function providerForValidCompositionCounterVerifiers()
    {
        return [
            [
                '',
                0,
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(),
                    new OneNumberVerifier()
                )
            ],
            [
                'test',
                '',
                array(
                    new NotNullVerifier(),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
            [
                'test string',
                2,
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
            [
                'tesT-String',
                4,
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(8),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
            [
                'TeST@String21',
                5,
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(5),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
        ];
    }

    public function providerForInvalidCompositionCounterVerifiers()
    {
        return [
            [
                '',
                3,
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(),
                    new OneNumberVerifier()
                )
            ],
            [
                'test',
                4,
                array(
                    new NotNullVerifier(),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
            [
                'test st',
                5,
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(8),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
            [
                'tesT-String',
                5,
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(10),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
            [
                'TeST@',
                5,
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(5),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
        ];
    }
}
