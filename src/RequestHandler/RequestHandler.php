<?php
/**
 * http-requester - RequestHandler.php
 *
 * Date: 4/18/18
 * Time: 12:23 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */
namespace Lamsa\RequestHandler;

use Lamsa\RequestHandler\Event\ResponseEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class RequestHandler
 * @package Lamsa\RequestHandler
 */
class RequestHandler implements RequestHandlerInterface
{
    const EVENT_NAME = 'responseReceived';

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var RequestHandlerInterface
     */
    private $requestHandler;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * RequestHandler constructor.
     * @param EventDispatcherInterface $eventDispatcher
     * @param RequestHandlerInterface $requestHandler
     * @param LoggerInterface $logger
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, RequestHandlerInterface $requestHandler, LoggerInterface $logger)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->requestHandler = $requestHandler;
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $response = $this->requestHandler->handle($request);
        $this->eventDispatcher->dispatch(RequestHandler::EVENT_NAME, new ResponseEvent($response));
        return $response;
    }
}
