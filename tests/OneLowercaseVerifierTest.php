<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 13:16
 */

namespace Verifier;

class OneLowercaseVerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidLowercase
     */
    public function testOneLowercaseValuesShouldReturnTrue($value)
    {
        $verifier = new OneLowercaseVerifier($value);
        $this->assertTrue($verifier->check($value));
        $this->assertTrue($verifier->verify($value));
    }

    /**
     * @dataProvider providerForInvalidLowercase
     * @expectedException \Verifier\Exceptions\OneLowercaseVerifierException
     */
    public function testNotLowercaseValuesShouldThrowSpecificException($value)
    {
        $verifier = new OneLowercaseVerifier($value);
        $this->assertTrue($verifier->verify($value));
    }

    public function providerForValidLowercase()
    {
        return [
            ['testtring'],
            ['tESTSTRING'],
            ['test-string'],
            ['test string'],
            ['2 test string 01'],
            ['test@string #']
        ];
    }

    public function providerForInvalidLowercase()
    {
        return [
            [''],
            ['TESTSTRING'],
            ['TEST-STRING'],
            ['TEST STRING'],
            ['2 TEST STRING 01'],
            ['TEST@STRING #']
        ];
    }
}
