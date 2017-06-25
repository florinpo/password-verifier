<?php
/**
 * User: florinpo
 * Date: 22/06/2017
 * Time: 20:03
 */

namespace Verifier;

class NotNullVerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForNotNull
     */
    public function testNotNullValuesShouldReturnTrue($value)
    {
        $verifier = new NotNullVerifier();
        $this->assertTrue($verifier->check($value));
        $this->assertTrue($verifier->verify($value));
    }

    /**
     * @expectedException \Verifier\Exceptions\NotNullVerifierException
     */
    public function testVerifyNullValuesShouldThrowSpecificException()
    {
        $verifier = new NotNullVerifier();
        $this->assertTrue($verifier->verify(NULL));
    }

    public function providerForNotNull()
    {
        return [
            [''],
            [' '],
            [0],
            ['log pasr'],
            ['O@me!'],
        ];
    }
}