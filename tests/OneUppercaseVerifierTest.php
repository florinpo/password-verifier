<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 14:32
 */

namespace Verifier;

class OneUppercaseVerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidUppercase
     */
    public function testOneUppercaseValuesShouldReturnTrue($value)
    {
        $verifier = new OneUppercaseVerifier($value);
        $this->assertTrue($verifier->check($value));
        $this->assertTrue($verifier->verify($value));
    }

    /**
     * @dataProvider providerForInvalidUppercase
     * @expectedException \Verifier\Exceptions\OneUppercaseVerifierException
     */
    public function testNotUppercaseValuesShouldThrowSpecificException($value)
    {
        $verifier = new OneUppercaseVerifier($value);
        $this->assertTrue($verifier->verify($value));
    }

    public function providerForValidUppercase()
    {
        return [
            ['TESTSTRING'],
            ['Teststring'],
            ['Test-string'],
            ['test String'],
            ['2 Test String 01'],
            ['test@String #']
        ];
    }

    public function providerForInvalidUppercase()
    {
        return [
            [' '],
            ['testtring'],
            ['test-string'],
            ['test string'],
            ['2 test string 01'],
            ['test@string #']
        ];
    }
}
