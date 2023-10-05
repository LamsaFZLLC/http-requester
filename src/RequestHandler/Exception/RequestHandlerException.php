<?php
/**
 * http-requester - RequestHandlerException.php
 *
 * Date: 4/24/18
 * Time: 2:53 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */

namespace Lamsa\RequestHandler\Exception;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * Class RequestHandlerException
 * @package Lamsa\RequestHandler\Exception
 */
class RequestHandlerException extends Exception implements HttpExceptionInterface
{
    /**
     * @var string
     */
    const MESSAGE = 'an error occurred while calling ';

    /**
     * RequestHandlerException constructor.
     *
     * @param string $url
     * @param string $exception
     */
    public function __construct(string $url,string $exception)
    {
        $ex = static::MESSAGE.$url.' Exception : '.$exception;
        parent::__construct($ex);
    }

    /**
     * Returns the status code.
     *
     * @return int An HTTP response status code
     */
    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }

    /**
     * Returns response headers.
     *
     * @return array Response headers
     */
    public function getHeaders(): array
    {
        return [];
    }
}