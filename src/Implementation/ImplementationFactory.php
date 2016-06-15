<?php

namespace Svea\Checkout\Implementation;

use Svea\Checkout\Transport\Connector;
use Svea\Checkout\Validation\ValidateCreateOrderData;
use Svea\Checkout\Validation\ValidateGetOrderData;
use Svea\Checkout\Validation\ValidateUpdateOrderData;

class ImplementationFactory
{
    /**
     * @param Connector $connector
     * @return ImplementationInterface
     */
    public static function returnCreateOrderClass(Connector $connector)
    {
        return new CreateOrder($connector, new ValidateCreateOrderData());
    }

    /**
     * @param Connector $connector
     * @return ImplementationInterface
     */
    public static function returnGetOrderClass(Connector $connector)
    {
        return new GetOrder($connector, new ValidateGetOrderData());
    }

    /**
     * @param Connector $connector
     * @return ImplementationInterface
     */
    public static function returnGetOrderSubsystemClass(Connector $connector)
    {
        return new GetOrderSubsystemInfo($connector, new ValidateGetOrderData());
    }

    /**
     * @param Connector $connector
     * @return ImplementationInterface
     */
    public static function returnUpdateOrderClass(Connector $connector)
    {
        return new UpdateOrder($connector, new ValidateUpdateOrderData());
    }
}