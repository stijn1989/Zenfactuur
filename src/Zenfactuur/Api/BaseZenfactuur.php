<?php
namespace Diagro\Zenfactuur\Api;


use Diagro\Zenfactuur\Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

abstract class BaseZenfactuur
{


    const END_POINT = 'https://www.zenfactuur.be/api/v2/';


    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $token;


    public function __construct($token)
    {
        $this->token = $token;
        $this->client = new Client();
    }


    protected function getToken() : string
    {
        return $this->token;
    }


    /**
     * Factories the request URI.
     *
     * @param $path
     * @param array $parameters
     * @return string
     */
    private function factoryUri($path, array $parameters = [])
    {
        $uri = self::END_POINT;
        $uri .= $path;

        $parameters['token'] = $this->getToken();
        $uri .= '?'. http_build_query($parameters);
        return $uri;
    }


    /**
     *
     *
     * @param Response $response
     * @throws Exception
     */
    private function handleError(Response $response)
    {
        $body = (string) $response->getBody();
        $code = (int) $response->getStatusCode();

        $content = json_decode($body, true);

        if(! empty($content)) {
            throw new Exception($this->arrayToString($content));
        } else {
            throw new Exception("Error on the request.");
        }
    }


    /**
     * Converts an array of strings to one string.
     * Each line is separated with an line separator.
     *
     * @param array $array
     * @param string $str
     * @return string
     */
    private function arrayToString(array $array, $str = '')
    {
        foreach($array as $value) {
            if(is_string($value)) {
                $str .= $value . '\n';
            } elseif(is_array($value)) {
                $str .= $this->arrayToString($value, $str);
            }
        }

        return $str;
    }


    /**
     * Performs a GET API request to Zenfactuur.
     *
     * @param $uri
     * @param array $parameters
     * @return mixed
     * @throws Exception
     */
    public function get($uri, array $parameters = [])
    {
        $response = null;
        try {
            $url = $this->factoryUri($uri, $parameters);
            $response = $this->client->get($url);
        } catch (RequestException $e) {
            $this->handleError($e->getResponse());
        }

        return json_decode($response->getBody(), true);
    }


    /**
     * Performs a POST API request to Zenfactuur.
     *
     * @param $uri
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function post($uri, array $data = [])
    {
        $response = null;
        try {
            $options = [];
            $options['json'] = $data;

            $url = $this->factoryUri($uri);
            $response = $this->client->post($url, $options);
        } catch (RequestException $e) {
            $this->handleError($e->getResponse());
        }

        return json_decode($response->getBody(), true);
    }


    /**
     * Performs a PUT API request to Zenfactuur.
     *
     * @param $uri
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function put($uri, array $data = [])
    {
        $response = null;
        try {
            $options = [];
            $options['json'] = $data;

            $url = $this->factoryUri($uri);
            $response = $this->client->put($url, $options);
        } catch (RequestException $e) {
            $this->handleError($e->getResponse());
        }

        return json_decode($response->getBody(), true);
    }


}