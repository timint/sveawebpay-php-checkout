<?php

namespace Svea\Checkout;

use Svea\Checkout\Implementation\CreateOrder;
use Svea\Checkout\Transport\Connector;

/**
 * ### Namespaces
 * The package makes use of PHP namespaces, grouping most classes under the namespace Svea\Checkout.
 *
 * The underlying services and methods are contained in the Svea sub-namespaces WebService,
 * HostedService and AdminService, and may be accessed,
 * though their api and interfaces are subject to change in the future.
 *
 * ### Documentation format
 * See the provided README.md file for an overview and examples how to utilise the CheckoutClient class.
 *
 * ### Development environment
 * The Svea Checkout PHP integration library is developed and tested using PhpStorm 10.
 *
 * Class CheckoutClient
 * @package Svea\Checkout
 * @author Svea
 */
class CheckoutClient
{
    /**
     * Transport connector used to make HTTP request to Svea Checkout API.
     *
     * @var Connector
     */
    private $connector;

    /**
     * CheckoutClient constructor.
     *
     * @param Connector $connector
     */
    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Create new Svea Checkout order.
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $co = new CreateOrder($this->connector);
        return $co->execute($data);
    }

    /**
     * Update existing Svea Checkout order.
     *
     * @param array $data
     */
    public function update(array $data)
    {

    }

    /**
     * Return Svea Checkout order data.
     *
     * @param $data
     */
    public function get($data)
    {

    }
}
