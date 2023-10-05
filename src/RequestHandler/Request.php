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
     * @var mixed
     */
    private $body;

    /**
     * @var string
     */
    private $returnClassName = null;

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
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri(): string
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
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getReturnClassName(): ?string
    {
        return $this->returnClassName;
    }

}
