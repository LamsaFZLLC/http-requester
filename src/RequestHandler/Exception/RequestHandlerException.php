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

/**
 * Class RequestHandlerException
 * @package Lamsa\RequestHandler\Exception
 */
class RequestHandlerException extends Exception
{
    /**
     * @var string
     */
    const MESSAGE = 'an error occurred while calling';

    /**
     * UserSubscriptionAlreadyCanceled constructor.
     */
    public function __construct()
    {
        parent::__construct(static::MESSAGE);
    }

    /**
     * Returns the status code.
     *
     * @return int An HTTP response status code
     */
    public function getStatusCode()
    {
        return Response::HTTP_CONFLICT;
    }

    /**
     * Returns response headers.
     *
     * @return array Response headers
     */
    public function getHeaders()
    {
        return [];
    }
}