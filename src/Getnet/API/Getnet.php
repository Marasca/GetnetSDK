<?php
namespace Getnet\API;
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 09/07/2018
     * Time: 01:26
     * Documentation https://api.getnet.com.br/v1/doc/api
     */

    /**
     * Class Getnet
     * @package Getnet\API
     */
/**
 * Class Getnet
 * @package Getnet\API
 */
class Getnet
{
    public $debug = true;
    /**
     * @var Request
     */
    private $client_id;
    /**
     * @var
     */
    private $client_secret;
    /**
     * @var
     */
    private $env;
    /**
     * @var
     */
    private $authorizationToken;

    /**
     * Getnet constructor.
     * @param $client_id
     * @param $client_secret
     * @param $env
     */

    public function __construct($client_id, $client_secret, $env)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->env = $env;

        $request = new Request($this);

        return $request->auth($this);


    }

    /**
     * @return $this
     */
    public function getAuthorizationToken()
    {
        return $this->authorizationToken;
    }

    /**
     * @param $this $authorizationToken
     */
    public function setAuthorizationToken($authorizationToken)
    {
        $this->authorizationToken = $authorizationToken;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->client_secret;
    }

    /**
     * @param mixed $client_secret
     */
    public function setClientSecret($client_secret)
    {
        $this->client_secret = $client_secret;
    }

    /**
     * @return mixed
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * @param mixed $env
     */
    public function setEnv($env)
    {
        $this->env = $env;
    }


    /**
     * @param Transaction $transaction
     * @return AuthorizeResponse
     */
    public function Authorize(Transaction $transaction)
    {
        try {
            $request = new Request($this);
            $response = $request->post($this, "/v1/payments/credit", $transaction->toJSON());
        } catch (\Exception $e) {

            $error = new BaseResponse();
            $error->mapperJson(json_decode($e->getMessage(), true));

            return $error;
        }
        print_r($response);
        $authresponse = new AuthorizeResponse();
        $authresponse->mapperJson($response);

        return $authresponse;
    }
}

