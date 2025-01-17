<?php

/**
 * Replaces the order rows of the specified order with the new appended in the call.
 *
 *
 * Include Library
 *
 * If you use Composer, include the autoload.php file from vendor folder
 * require_once '../vendor/autoload.php';
 *
 * If you do not use Composer, include the include.php file from root of the project
 * require_once '../include.php';
 */
require_once __DIR__.'/../vendor/autoload.php';

/**
 * Create connector for given
 * Merchant Id - unique merchant ID
 * Shared Secret - Shared Secret string between Svea and merchant
 * Base Url for SVEA Api. Can be STAGE_BASE_URL and PROD_BASE_URL
 */
$checkoutMerchantId = 100002;
$checkoutSecret = "3862e010913d7c44f104ddb4b2881f810b50d5385244571c3327802e241140cc692522c04aa21c942793c8a69a8e55ca7b6131d9ac2a2ae2f4f7c52634fe30d2";
$baseUrl = \Svea\Checkout\Transport\Connector::TEST_BASE_URL;

try {
	/**
	 * Create Connector object
	 *
	 * Exception \Svea\Checkout\Exception\SveaConnectorException will be returned if
	 * some of fields $merchantId, $sharedSecret and $baseUrl is missing
	 *
	 *
	 * Update Order
	 *
	 * Initialize getting the order information
	 *  Possible Exceptions are:
	 *  \Svea\Checkout\Exception\SveaInputValidationException - if $orderId is missing
	 *  \Svea\Checkout\Exception\SveaApiException - is there is some problem with api connection or
	 *      some error occurred with data validation on API side
	 *  \Exception - for any other error
	 */
	$conn = \Svea\Checkout\Transport\Connector::init($checkoutMerchantId, $checkoutSecret, $baseUrl);
	$checkoutClient = new \Svea\Checkout\CheckoutClient($conn);

	/**
	 * Example of update the order and getting the response data
	 */
	$data = [
		"orderId" => 251147,
		"merchantData" => "test",
		"cart" => [
			"items" => [
				[
					"articleNumber" => "123456",
					"name" => "Yellow rubber duck",
					"quantity" => 200,
					"unitPrice" => 66600,
					"discountPercent" => 1000,
					"vatPercent" => 2500,
					"temporaryReference" => "230",
					"merchantData" => "Size: M"
				],
				[
					"type" => "shipping_fee",
					"articleNumber" => "658475",
					"name" => "Shipping Fee Updated",
					"quantity" => 100,
					"unitPrice" => 4900,
					"vatPercent" => 2500,
					"temporaryReference" => "231",
					"merchantData" => null
				]
			]
		]
	];

	$response = $checkoutClient->update($data);

	/*
	 * Format of returned response array
	 *
	 * Response:
	 *  - MerchantSettings
	 *      - TermsUri
	 *      - CheckoutUri
	 *      - ConfirmationUri
	 *      - PushUri
	 *  - Cart
	 *      - Items [..] / list of items
	 *          - ArticleNumber
	 *          - Name
	 *          - Quantity
	 *          - UnitPrice
	 *          - DiscountPercent
	 *          - VatPercent
	 *          - Unit
	 *          - TemporaryReference
	 *  - Customer
	 *  - ShippingAddress
	 *  - BillingAddress
	 *  - Gui
	 *      - Layout
	 *      - Snippet
	 *  - Locale
	 *  - Currency
	 *  - CountryCode
	 *  - PresetValues
	 *  - OrderId
	 *  - Status
	 * */
	$orderId = $response['OrderId'];
	$guiSnippet = $response['Gui']['Snippet'];
	$orderStatus = $response['Status'];

	echo '<pre>' . print_r($response, true) . '</pre>';

} catch (\Svea\Checkout\Exception\SveaApiException $ex) {
	examplePrintError($ex, 'Api errors');
} catch (\Svea\Checkout\Exception\SveaConnectorException $ex) {
	examplePrintError($ex, 'Conn errors');
} catch (\Svea\Checkout\Exception\SveaInputValidationException $ex) {
	examplePrintError($ex, 'Input data errors');
} catch (Exception $ex) {
	examplePrintError($ex, 'General errors');
}

function examplePrintError(Exception $ex, $errorTitle)
{
	print_r('--------- ' . $errorTitle . ' ---------' . PHP_EOL);
	print_r('Error message -> ' . $ex->getMessage() . PHP_EOL);
	print_r('Error code -> ' . $ex->getCode() . PHP_EOL);
}
