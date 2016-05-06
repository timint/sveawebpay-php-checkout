<?php

namespace Svea\Checkout\Implementation;

use Svea\Checkout\Model\Cart;
use Svea\Checkout\Model\CheckoutData;
use Svea\Checkout\Model\MerchantSettings;
use Svea\Checkout\Model\OrderRow;
use Svea\Checkout\Model\Request;
use Svea\Checkout\Validation\ValidateCreateOrderData;

class CreateOrder extends ImplementationManager
{
    const API_URL = '/api/orders/';

    /**
     * @var CheckoutData
     */
    private $checkoutData;

    /**
     * Request body - JSON
     *
     * @var string $requestBodyData
     */
    private $requestBodyData;

    public function validateData($data)
    {
        $validation = new ValidateCreateOrderData();
        $validation->validate($data);
    }

    public function mapData($data)
    {
        // - checkout data
        $checkoutData = new CheckoutData();

        // - merchant setting
        $merchantData = $data['merchant_urls'];
        $merchantSettings = new MerchantSettings();
        $merchantSettings->setTermsUri($merchantData['terms']);
        $merchantSettings->setCheckoutUri($merchantData['checkout']);
        $merchantSettings->setConfirmationUri($merchantData['confirmation']);
        $merchantSettings->setPushUri($merchantData['push']);

        $checkoutData->setMerchantSettings($merchantSettings);

        $cart = new Cart();

        $orderLines = $data['order_lines'];
        foreach ($orderLines as $orderLine) {
            $orderRow = new OrderRow();
            $orderRow->setItemParameters($orderLine);

            $cart->addItem($orderRow);
        }

        $checkoutData->setCart($cart);

        $checkoutData->setLocale($data['locale']);
        $checkoutData->setCurrency($data['purchase_currency']);
        $checkoutData->setCountryCode($data['purchase_country']);

        $this->checkoutData = $checkoutData;
    }

    public function prepareData()
    {
        $checkoutData = $this->checkoutData;

        $merchantSettings = $checkoutData->getMerchantSettings();
        $cart = $checkoutData->getCart();

        $preparedData = array();
        $preparedData['merchantSettings'] = array(
            'termsuri' => $merchantSettings->getTermsUri(),
            'checkouturi' => $merchantSettings->getCheckoutUri(),
            'confirmationuri' => $merchantSettings->getConfirmationUri(),
            'pushuri' => $merchantSettings->getPushUri()
        );

        $cartItems = $cart->getItems();
        $preparedData['cart'] = array();
        foreach ($cartItems as $item) {
            /* @var $item OrderRow */
            $preparedData['cart']['items'][] = $item->getItemParameters();
        }

        $preparedData['locale'] = $checkoutData->getLocale();
        $preparedData['countrycode'] = $checkoutData->getCountryCode();
        $preparedData['currency'] = $checkoutData->getCurrency();

        $this->requestBodyData = json_encode($preparedData);
    }


    /**
     * Invoke request call
     *
     * @throws \Svea\Checkout\Exception\SveaApiException
     */
    public function invoke()
    {
        $requestModel = new Request();
        $requestModel->setPostMethod();
        $requestModel->setBody($this->requestBodyData);
        $requestModel->setApiUrl($this->connector->getApiUrl() . self::API_URL);

        $this->response = $this->connector->sendRequest($requestModel);
    }

    /**
     * @return CheckoutData
     */
    public function getCheckoutData()
    {
        return $this->checkoutData;
    }

    /**
     * @param CheckoutData $checkoutData
     */
    public function setCheckoutData($checkoutData)
    {
        $this->checkoutData = $checkoutData;
    }

    /**
     * @return string
     */
    public function getRequestBodyData()
    {
        return $this->requestBodyData;
    }

    /**
     * @param string $requestBodyData
     */
    public function setRequestBodyData($requestBodyData)
    {
        $this->requestBodyData = $requestBodyData;
    }
}
