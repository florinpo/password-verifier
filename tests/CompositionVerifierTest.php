<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 20:44
 */

namespace Verifier;

class CompositionVerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidCompositionVerifiers
     */
    public function testValidVerifiersShouldReturnTrue($string, $verifiers)
    {
        $verifier = new CompositionVerifier($verifiers);
        $this->assertTrue($verifier->check($string));
        $this->assertTrue($verifier->verify($string));
    }

    /**
     * @dataProvider providerForInvalidCompositionVerifiers
     */
    public function testInvalidVerifiersShouldReturnFalse($string, $verifiers)
    {
        $verifier = new CompositionVerifier($verifiers);
        $this->assertFalse($verifier->check($string));
    }

    /**
     * @expectedException \Verifier\Exceptions\GreaterThanVerifierException
     */
    public function testFirstInvalidGreaterThanVerifierShouldThrowItsException()
    {
        $verifier = new CompositionVerifier(
            array(
                new GreaterThanVerifier(8),
                new NotNullVerifier(),
                new OneNumberVerifier(),
                new OneLowercaseVerifier()
            )
        );

        $verifier->verify('test1');
    }

    /**
     * @expectedException \Verifier\Exceptions\OneUppercaseVerifierException
     */
    public function testFirstInvalidOneUpppercaseVerifierShouldThrowItsException()
    {
        $verifier = new CompositionVerifier(
            array(
                new GreaterThanVerifier(4),
                new NotNullVerifier(),
                new OneNumberVerifier(),
                new OneLowercaseVerifier(),
                new OneUppercaseVerifier()
            )
        );

        $verifier->verify('test1');
    }

    public function providerForValidCompositionVerifiers()
    {
        return [
            [
                'test',
                array(
                    new NotNullVerifier(),
                    new OneLowercaseVerifier()
                )
            ],
            [
                'test string01',
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(8),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier()
                )
            ],
            [
                'tesT-String',
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(8),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
            [
                'TeST@String21',
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

    public function providerForInvalidCompositionVerifiers()
    {
        return [
            [
                '',
                array(
                    new NotNullVerifier(),
                    new OneLowercaseVerifier()
                )
            ],
            [
                'test string',
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(8),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier()
                )
            ],
            [
                'tesT-Strin',
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(8),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
            [
                'TeST@Strng',
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(5),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
            [
                'TST@S',
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(4),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                )
            ],
        ];
    }
}