<?php
/**
 * User: florinpo
 * Date: 22/06/2017
 * Time: 13:11
 */

namespace Verifier\Exceptions;

class VerifierException extends \InvalidArgumentException
{
    public static $templateMessage = 'Verification failed for %s';

    protected $params;
    protected $fieldName;

    public function __toString()
    {
        return $this->getMainMessage();
    }

    public function configure($params, $fieldName)
    {
        $this->setParams($params);
        $this->setFieldName($fieldName);
    }

    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    public function getParams()
    {
        return $this->params;
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

    public function getMainMessage()
    {
        return sprintf(static::$templateMessage, $this->getFieldName());
    }
}