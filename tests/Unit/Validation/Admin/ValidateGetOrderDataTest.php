<?php

namespace Svea\Checkout\Tests\Unit\Validation\Admin;

use Svea\Checkout\Tests\Unit\TestCase;
use Svea\Checkout\Validation\Admin\ValidateGetOrderData;

class ValidateGetOrderDataTest extends TestCase
{
	public function testValidateWithOrderIdAsIntInArray()
	{
		$data = [
			'orderid' => 1234
		];
		$validateGetOrder = new ValidateGetOrderData();
		$validateGetOrder->validate($data);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithOrderIdAsInteger()
	{
		$data = 1234;
		$validateGetOrder = new ValidateGetOrderData();
		$validateGetOrder->validate($data);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithoutOrderId()
	{
		$data = [];
		$validateGetOrder = new ValidateGetOrderData();
		$validateGetOrder->validate($data);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithOrderIdAsString()
	{
		$data = '1234';
		$validateGetOrder = new ValidateGetOrderData();
		$validateGetOrder->validate($data);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithEmptyString()
	{
		$data = '';
		$validateGetOrder = new ValidateGetOrderData();
		$validateGetOrder->validate($data);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithOrderIdAsStringInArray()
	{
		$data = [
			'orderid' => '1234'
		];
		$validateGetOrder = new ValidateGetOrderData();
		$validateGetOrder->validate($data);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithEmptyStringInArray()
	{
		$data = [
			'orderid' => ''
		];
		$validateGetOrder = new ValidateGetOrderData();
		$validateGetOrder->validate($data);
	}
}
