<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 15:07
 */

namespace Verifier;

class OneNumberVerrifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidOneNumber
     */
    public function testOneNumberValuesShouldReturnTrue($value)
    {
        $verifier = new OneNumberVerifier($value);
        $this->assertTrue($verifier->check($value));
        $this->assertTrue($verifier->verify($value));
    }

    /**
     * @dataProvider providerForInvalidOneNumber
     * @expectedException \Verifier\Exceptions\OneNumberVerifierException
     */
    public function testNotUppercaseValuesShouldThrowSpecificException($value)
    {
        $verifier = new OneNumberVerifier($value);
        $this->assertTrue($verifier->verify($value));
    }

    public function providerForValidOneNumber()
    {
        return [
            ['0111100'],
            ['011 21100'],
            ['011-21100'],
            ['teststring-01'],
            ['Test-string@01']
        ];
    }

    public function providerForInvalidOneNumber()
    {
        return [
            [' '],
            ['teststring'],
            ['test-string'],
            ['test string'],
            ['TestString'],
            ['teststring@!'],
            ['TestString@#'],
        ];
    }
}
