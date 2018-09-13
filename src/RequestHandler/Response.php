<?php
/**
 * http-requester - Response.php
 *
 * Date: 4/18/18
 * Time: 12:23 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */
namespace Lamsa\RequestHandler;

/**
 * Class Response
 * @package Lamsa\RequestHandler
 */
class Response
{
    const HTTP_BAD_REQUEST = 400;

    /**
     * @var integer
     */
    private $statusCode;

    /**
     * @var array
     */
    private $headers = array();

    /**
     * @var mixed
     */
    private $body;

    /**
     * Response constructor.
     * @param $statusCode
     */
    public function __construct($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param array $headers
     * @return Response
     */
    public function setHeaders(array $headers):Response
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @param $name
     * @return array
     */
    public function getHeader($name): ?array
    {
        return (isset($this->headers[$name]) ? $this->headers[$name] : null);
    }

    /**
     * @param $body
     * @return Response
     */
    public function setBody($body):Response
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
