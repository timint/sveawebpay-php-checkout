<?php

namespace Svea\Checkout\Transport;

use \Exception;
use Svea\Checkout\Exception\ExceptionCodeList;
use Svea\Checkout\Model\Request;
use Svea\Checkout\Transport\Http\HttpRequestInterface;

/**
 * Class ApiClient - Used to make a request to Svea Checkout API
 *
 * @package Svea\Checkout\Transport
 */
class ApiClient
{
	/**
	 * Implementation of Http client interface.
	 *
	 * @var HttpRequestInterface $httpClient
	 */
	private $httpClient;

	/**
	 * Client constructor.
	 *
	 * @param HttpRequestInterface $httpClient PHP HTTP client that makes it easy to send HTTP requests
	 */
	public function __construct(HttpRequestInterface $httpClient)
	{
		$this->httpClient = $httpClient;
	}

	/**
	 * Send request to Svea Checkout API.
	 *
	 * @param Request $request Request model
	 * @throws Exception        When an error is encountered
	 * @return ResponseHandler
	 */
	public function sendRequest(Request $request)
	{

		if (!in_array($request->getMethod(), ['GET', 'POST', 'PUT', 'PATCH'])) {
			throw new Exception('Unknown request method ('. $request->getMethod() .')');
		}

		$headers = [
			'Content-type: application/json; charset=utf-8',
			'Authorization: Svea ' . $request->getAuthorizationToken(),
			'Timestamp: ' . $request->getTimestamp(),
			'Expect:',
		];

		$this->httpClient->init();
		$this->httpClient->setOptions([
			CURLOPT_CUSTOMREQUEST  => $request->getMethod(),
			CURLOPT_URL            => $request->getApiUrl(),
			CURLOPT_HTTPHEADER     => $headers,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER         => true,
		]);

		if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'])) {
			$this->httpClient->setOption(CURLOPT_POSTFIELDS, $request->getBody());
		}

		$httpResponse = $this->httpClient->execute();
		$httpCode = $this->httpClient->getInfo(CURLINFO_HTTP_CODE);

		$httpError = $this->httpClient->getError();
		$errorNumber = $this->httpClient->getErrorNumber();

		$this->httpClient->close();

		if ($errorNumber > 0) {
			throw new Exception(" Curl error " . $errorNumber . " " . $httpError, ExceptionCodeList::COMMUNICATION_ERROR);
		}

		$responseHandler = new ResponseHandler($httpResponse, $httpCode);
		$responseHandler->handleClientResponse();

		return $responseHandler;
	}
}
