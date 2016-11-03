<?php


namespace Svea\Checkout\Implementation\Admin;

use Svea\Checkout\Model\Request;

class GetOrderCredit extends AdminImplementationManager
{
    /**
     * url of action
     */
    protected $apiUrl = '/api/v1/orders/%d/deliveries/%d/credits/%s';

    /**
     * Request body - JSON
     *
     * @var Request $requestModel
     */
    private $requestModel;

    /**
     * Input data validation
     *
     * @param mixed $data Input data to Svea Checkout Library
     */
    public function validateData($data)
    {
        $this->validator->validate($data);
    }

    /**
     * Prepare body data for Api call
     *
     * @param mixed $data
     */
    public function prepareData($data)
    {
        $creditId = isset($data['creditid']) > 0 ? $data['creditid'] : '';

        $params = array($data['id'], $data['deliveryid'], $creditId);

        $this->requestModel = new Request();
        $this->requestModel->setGetMethod();
        $this->requestModel->setApiUrl($this->prepareUrl($params));
    }

    /**
     * Invoke Api call
     */
    public function invoke()
    {
        $this->response = $this->connector->sendRequest($this->requestModel);
    }

    /**
     * @return Request
     */
    public function getRequestModel()
    {
        return $this->requestModel;
    }

    /**
     * @param Request $requestModel
     */
    public function setRequestModel($requestModel)
    {
        $this->requestModel = $requestModel;
    }
}