<?php
/**
 * http-requester - RequestHandlerTest.php
 *
 * Date: 4/24/18
 * Time: 7:19 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */

namespace Tests\Lamsa;

use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use Lamsa\RequestHandler\Middleware\GuzzleRequestHandler;
use Lamsa\RequestHandler\Request;
use Lamsa\RequestHandler\RequestHandler;
use Lamsa\RequestHandler\RequestHandlerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class RequestHandlerTest extends TestCase
{
    /**
     * @var RequestHandlerInterface
     */
    private $guzzleRequestHandler;

    /**
     * @var EventDispatcherInterface|MockObject
     */
    private $eventDispatcherMock;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->eventDispatcherMock  = $this->createMock(EventDispatcherInterface::class);
        $guzzle                     = new Client();
        $serializer                 = $this->createMock(SerializerInterface::class);
        $this->guzzleRequestHandler = new GuzzleRequestHandler($guzzle, $serializer);
    }

    /**
     *
     */
    public function testHandleRequest()
    {
        $request = new Request('get', "http://ip-api.com/json/");
        $request->setHeader('Content-Type', 'application/json');

        $requestHandler = new RequestHandler($this->eventDispatcherMock, $this->guzzleRequestHandler);
        $response       = $requestHandler->handle($request);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
    }
}