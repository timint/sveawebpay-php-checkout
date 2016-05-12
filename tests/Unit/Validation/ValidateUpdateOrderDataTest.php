<?php

namespace Svea\Checkout\Tests\Unit\Validation;

use Svea\Checkout\Tests\Unit\TestCase;
use Svea\Checkout\Validation\ValidateUpdateOrderData;

class ValidateUpdateOrderDataTest extends TestCase
{
    /**
     * @var ValidateUpdateOrderData $validateUpdateOrderData
     */
    private $validateUpdateOrderData;

    public function setUp()
    {
        parent::setUp();
        $this->validateUpdateOrderData = new ValidateUpdateOrderData($this->inputUpdateData);
    }

    /**
     * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
     * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
     */
    public function testValidateOrderIdWithUnsetField()
    {
        unset($this->inputUpdateData['id']);
        $this->invokeMethod($this->validateUpdateOrderData, 'validateOrderId', array($this->inputUpdateData));
    }

    /**
     * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
     * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
     */
    public function testValidateOrderIdWithEmptyStringFiled()
    {
        $this->inputUpdateData['id'] = '';
        $this->invokeMethod($this->validateUpdateOrderData, 'validateOrderId', array($this->inputUpdateData));
    }

    /**
     * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
     * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
     */
    public function testValidateOrderIdWithFalseValueField()
    {
        $this->inputUpdateData['id'] = false;
        $this->invokeMethod($this->validateUpdateOrderData, 'validateOrderId', array($this->inputUpdateData));
    }

    public function testValidateOrderIdWithZeroValueField()
    {
        $this->inputUpdateData['id'] = 1230;
        $this->invokeMethod($this->validateUpdateOrderData, 'validateOrderId', array($this->inputUpdateData));
    }

    /**
     * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
     * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
     */
    public function testValidateOrderCartWithCartNoArrayData()
    {
        $this->inputUpdateData['cart'] = '';
        $this->invokeMethod($this->validateUpdateOrderData, 'validateOrderCart', array($this->inputUpdateData));
    }

    /**
     * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
     * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
     */
    public function testValidateOrderCartWithItemsNoArrayData()
    {
        $this->inputUpdateData['cart']['items'] = '';
        $this->invokeMethod($this->validateUpdateOrderData, 'validateOrderCart', array($this->inputUpdateData));
    }

    /**
     * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
     * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
     */
    public function testValidateOrderCartWithCartEmptyArrayData()
    {
        $this->inputUpdateData['cart'] = array();
        $this->invokeMethod($this->validateUpdateOrderData, 'validateOrderCart', array($this->inputUpdateData));
    }

    public function testValidateOrderCartWithValidData()
    {
        $this->invokeMethod($this->validateUpdateOrderData, 'validateOrderCart', array($this->inputUpdateData));
    }

    public function testValidateWithValidData()
    {
        $this->validateUpdateOrderData->validate($this->inputUpdateData);
    }
}
