<?php

namespace Svea\Checkout\Tests\Unit\Validation\Admin;

use Svea\Checkout\Tests\Unit\TestCase;
use Svea\Checkout\Validation\Admin\ValidateCreditOrderRowsWithFeeData;

class ValidateCreditOrderRowsWithFeeDataTest extends TestCase
{
	/**
	 * @var ValidateCreditOrderRowsWithFeeData $validateUpdateOrderData
	 */
	private $validateCreditOrderRow;

	/**
	 * @var mixed $inputData
	 */
	private $inputData;

	public function setUp()
	{
		parent::setUp();
		$this->validateCreditOrderRow = new ValidateCreditOrderRowsWithFeeData();

		$this->inputData = [
			"orderid" => 201,
			"deliveryid" => 1,
			"orderrowids" => [3],
			"fee" => [
				"articlenumber" => "123456",
				"name" => "Tomatoes",
				"quantity" => 10,
				"unitprice" => 600,
				"discountpercent" => 1000,
				"vatpercent" => 2500
			],
			"rowcreditingoptions" => [
				[
					"orderrowid" => 1,
					"quantity" => 1,
				]
			]
		];
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithoutOrderId()
	{
		unset($this->inputData['orderid']);
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithOrderIdAsString()
	{
		$this->inputData['orderid'] = '204';
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithEmptyOrderId()
	{
		$this->inputData['orderid'] = '';
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithNullOrderId()
	{
		$this->inputData['orderid'] = null;
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithOrderIdAsDecimal()
	{
		$this->inputData['orderid'] = 204.5;
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithoutDeliveryId()
	{
		unset($this->inputData['deliveryid']);
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithDeliveryIdAsString()
	{
		$this->inputData['deliveryid'] = '204';
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithEmptyDeliveryId()
	{
		$this->inputData['deliveryid'] = '';
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithNullDeliveryId()
	{
		$this->inputData['deliveryid'] = null;
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithDeliveryIdAsDecimal()
	{
		$this->inputData['deliveryid'] = 204.5;
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateCreditOrderRowIdsWithOrderRowIdsAsString()
	{
		$this->inputData['orderrowids'] = '204';
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateCreditOrderRowIdsWithEmptyOrderRowIds()
	{
		$this->inputData['orderrowids'] = '';
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateCreditOrderRowIdsWithOrderRowIdsAsDecimal()
	{
		$this->inputData['orderrowids'] = 204.5;
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateCreditOrderRowIdsWithOrderRowIdAsEmptyArray()
	{
		$this->inputData['orderrowids'] = [];
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateCreditOrderRowIdsWithOrderRowIdAsString()
	{
		$this->inputData['orderrowids'] = ['1'];
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateCreditOrderRowIdsWithOrderRowIdAsDecimal()
	{
		$this->inputData['orderrowids'] = [1.1];
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateCreditOrderRowIdsWithEmptyOrderRowId()
	{
		$this->inputData['orderrowids'] = [''];
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	/**
	 * @expectedException \Svea\Checkout\Exception\SveaInputValidationException
	 * @expectedExceptionCode Svea\Checkout\Exception\ExceptionCodeList::INPUT_VALIDATION_ERROR
	 */
	public function testValidateWithEmptyRowCreditingOptions()
	{
		$this->inputData['rowcreditingoptions'] = [];
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}

	public function testValidateWithoutRowCreditingOptions()
	{
		unset($this->inputData['rowcreditingoptions']);
		$this->invokeMethod($this->validateCreditOrderRow, 'validate', [$this->inputData]);
	}
}
