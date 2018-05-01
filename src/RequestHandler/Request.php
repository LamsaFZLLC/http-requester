<?php
/**
 * http-requester - Request.php
 *
 * Date: 4/18/18
 * Time: 12:23 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */
namespace Lamsa\RequestHandler;

/**
 * Class Request
 * @package Lamsa\RequestHandler
 */
class Request
{
    /**
     * @var string
     */
    private $method;
    /**
     * @var string
     */
    private $uri;

    /**
     * @var array
     */
    private $headers = array();

    /**
     * @var array
     */
    private $body;

    /**
     * Request constructor.
     * @param $method
     * @param $uri
     */
    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param $name
     * @param $value
     * @return Request
     */
    public function setHeader($name, $value):Request
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param $body
     * @return Request
     */
    public function setBody($body): Request
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
}
