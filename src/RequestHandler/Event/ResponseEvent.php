<?php
/**
 * http-requester - ResponseEvent.php
 *
 * Date: 4/18/18
 * Time: 12:23 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */

namespace Lamsa\RequestHandler\Event;


use Lamsa\RequestHandler\Response;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class ResponseEvent
 * @package Lamsa\RequestHandler\Event
 */
class ResponseEvent extends Event
{
    /**
     * @var Response $response
     */
    private $response;

    /**
     * ResponseEvent constructor.
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }
}
