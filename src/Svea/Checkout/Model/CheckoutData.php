<?php

namespace Svea\Checkout\Model;

/**
 * Class CheckoutData -  - Containing full Order information
 * @package Svea\Checkout\Model
 */
class CheckoutData
{
    /**
     * @var MerchantSettings $merchantSettings
     */
    private $merchantSettings;

    /**
     * @var Cart $cart
     */
    private $cart;

    /**
     * @var string $locale
     */
    private $locale;

    /**
     * @var string $currency
     */
    private $currency;

    /**
     * @var string $countryCode
     */
    private $countryCode;

    /**
     * @return MerchantSettings
     */
    public function getMerchantSettings()
    {
        return $this->merchantSettings;
    }

    /**
     * @param $merchantSettings
     */
    public function setMerchantSettings($merchantSettings)
    {
        $this->merchantSettings = $merchantSettings;
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param Cart $cart
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }
}
