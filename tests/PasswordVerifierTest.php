<?php
/**
 * User: florinpo
 * Date: 23/06/2017
 * Time: 21:18
 */

namespace Verifier;

class PasswordVerifierTest extends \PHPUnit_Framework_TestCase
{
    const COUNTER = 3;
    const THRESHHOLD = 8;

    private $passwordObj;

    protected function setUp()
    {
        $this->passwordObj = new PasswordVerifier(self::COUNTER, self::THRESHHOLD);
    }

    /**
     * @dataProvider providerForValidPassword
     */
    public function testValidPasswordShouldReturnTrue($string)
    {
        $this->assertTrue($this->passwordObj->check($string));
        $this->assertTrue($this->passwordObj->verify($string));
    }

    /**
     * @dataProvider providerForInvalidPassword
     */
    public function testInvalidPasswordShouldReturnFalse($string)
    {
        $this->assertFalse($this->passwordObj->check($string));
    }

    /**
     * @expectedException \Verifier\Exceptions\OneLowercaseVerifierException
     */
    public function testCapitalLettersPasswordShouldThrowAnError()
    {
        $this->passwordObj->verify('PASSWORD');
    }

    /**
     * @dataProvider providerForInvalidPassword
     * @expectedException \Verifier\Exceptions\VerifierException
     */
    public function testInvalidPasswordShouldThrowAnError($string)
    {
        $this->passwordObj->verify($string);
    }

    /**
     * @dataProvider providerForValidPassword
     */
    public function testV2ValidPasswordShouldReturnTrue($string)
    {
        $this->assertTrue($this->check2($string));
        $this->assertTrue($this->verify2($string));
    }
    /**
     * @dataProvider providerForInvalidPassword
     * @expectedException \Verifier\Exceptions\VerifierException
     */
    public function testV2InvalidPasswordShouldThrowAnException($string)
    {
        $this->assertTrue($this->verify2($string));
    }

    /**
     * Provider for valid password
     *
     * Provider for valid password according to http://osherove.com/tdd-kata-3-refactoring/
     * see items 2 and 3 from the specs
     */
    public function providerForValidPassword()
    {
        return [
            ['password1'],
            ['pass-word1'],
            ['Pass word'],
            ['Password1'],
            ['Pass1'],
            ['Pass1#!']
        ];
    }

    /**
     * Provider for invalid password
     *
     * Provider for invalid password according to http://osherove.com/tdd-kata-3-refactoring/
     * see items 2 and 3 from the specs
     */
    public function providerForInvalidPassword()
    {
        return [
            [null],
            [0],
            [''],
            ['password'],
            ['PASS'],
            ['P1'],
        ];
    }

    /**
     * check password idea for item 8
     *
     * item 3 never gets called if item 2 verification returns false
     * if e.g. password = "PASSWORD" one lowercase condition is not satisfied thus returns false
     */
    public function check2($input) {
        $lowerCaseVerifier = new OneLowercaseVerifier();

        if ($lowerCaseVerifier->check($input)) {
            $compositionVerifier = new CompositionCounterVerifier(
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(self::THRESHHOLD),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                ),
                self::COUNTER
            );

            if (!$compositionVerifier->check($input)) {
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * verify password idea for item 8
     *
     * item 3 never gets called if item 2 verification returns false
     * if e.g. password = "PASSWORD" one lowercase condition is not satisfied thus returns false
     */
    public function verify2($input) {
        $lowerCaseVerifier = new OneLowercaseVerifier();

        if ($lowerCaseVerifier->verify($input)) {
            $compositionVerifier = new CompositionCounterVerifier(
                array(
                    new NotNullVerifier(),
                    new GreaterThanVerifier(self::THRESHHOLD),
                    new OneNumberVerifier(),
                    new OneLowercaseVerifier(),
                    new OneUppercaseVerifier()
                ),
                self::COUNTER
            );

            if (!$compositionVerifier->verify($input)) {
                return false;
            }

            return true;
        }

        return false;
    }
}
