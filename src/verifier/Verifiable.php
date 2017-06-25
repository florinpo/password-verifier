<?php
/**
 * User: florinpo
 * Date: 21/06/2017
 * Time: 17:53
 */

namespace Verifier;

interface Verifiable
{
    public function verify($input);

    public function check($input);

    public function createError();
}