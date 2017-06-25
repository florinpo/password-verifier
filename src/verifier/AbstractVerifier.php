<?php
/**
 * User: florinpo
 * Date: 21/06/2017
 * Time: 18:24
 */

namespace Verifier;

abstract class AbstractVerifier implements Verifiable
{
    protected $fieldName = 'Field';

    public function verify($input)
    {
        if ($this->check($input)) {
            return true;
        }

        throw $this->createError();
    }

    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    public function getFieldName()
    {
        return $this->fieldName;
    }

    public function createError()
    {
        $exception = $this->useException();
        $exception->configure(get_object_vars($this), $this->fieldName);

        return $exception;
    }

    protected function useException()
    {
        $exceptionSpec = '\\Verifier\\Exceptions\\';
        $exceptionSpec .= (new \ReflectionClass($this))->getShortName();
        $exceptionSpec .= 'Exception';

        return new $exceptionSpec();
    }
}
