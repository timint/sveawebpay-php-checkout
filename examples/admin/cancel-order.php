<?php

/**
 * By setting the IsCancelled parameter to true the order is cancelled,
 * assuming the order has the action "CanCancelOrder".
 *
 *
 * Include Library
 *
 * If you use Composer, include the autoload.php file from vendor folder
 * require_once '../../vendor/autoload.php';
 *
 * If you do not use Composer, include the include.php file from root of the project
 * require_once '../../include.php';
 */
require_once __DIR__.'/../../include.php';

/**
 * Unique merchant ID
 * Shared Secret string between Svea and merchant
 * Base Url for SVEA Api. Can be TEST_ADMIN_BASE_URL and PROD_ADMIN_BASE_URL
 */
$checkoutMerchantId = 200093;
$checkoutSecret = "PFQOgSeRCy5fCuficPhVFcLFK8PJYHbjTK0cjfcuWwjaQhf6syI0pCGM3kdicF35wWv2Dc96NX8i2LYC3Tqz8l3rdnj8b3rrDoN4WmCqzMnCDxUswKpsoD6l2dZq3a4U";
$baseUrl = \Svea\Checkout\Transport\Connector::TEST_ADMIN_BASE_URL;

try {
	/**
	 * Create Connector object
	 *
	 * Exception \Svea\Checkout\Exception\SveaConnectorException will be returned if
	 * some of fields $merchantId, $sharedSecret and $baseUrl is missing
	 *
	 *
	 * Cancel Order
	 *
	 * Possible Exceptions are:
	 * \Svea\Checkout\Exception\SveaInputValidationException
	 * \Svea\Checkout\Exception\SveaApiException
	 * \Exception - for any other error
	 */
	$conn = \Svea\Checkout\Transport\Connector::init($checkoutMerchantId, $checkoutSecret, $baseUrl);
	$checkoutClient = new \Svea\Checkout\CheckoutAdminClient($conn);

	$data = array(
		"orderId" => 180212,
		"IsCancelled" => true
	);

	$response = $checkoutClient->cancelOrder($data);

	if ($response === '') {
		print_r('Success cancel amount');
	}
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
