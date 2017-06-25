<?php

/**
 * User: florinpo
 * Date: 21/06/2017
 * Time: 14:58
 */
namespace Verifier;

class GreaterThanVerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidLength
     */
    public function testStringLenghGreatherThanTreshholdShouldReturnTrue($string, $treshhold)
    {
        $verifier = new GreaterThanVerifier($treshhold);
        $this->assertTrue($verifier->verify($string));
    }

    /**
     * @dataProvider providerForInvalidLength
     * @expectedException \Verifier\Exceptions\GreaterThanVerifierException
     */
    public function testStringLenghNotGreatherThanTreshholdShouldThrowAnException($string, $treshhold)
    {
        $verifier = new GreaterThanVerifier($treshhold);
        $verifier->verify($string);
    }

    public function providerForValidLength()
    {
        return [
            ['volstcom', 5],
            ['~##{})', 4],
            ['volst com', 7],
            ['Volst@#com17', 10]
        ];
    }

    public function providerForInvalidLength()
    {
        return [
            ['vols', 5],
            ['~##{})', 8],
            ['lst com', 7],
            ['Volt@#co17', 10],
        ];
    }
}
