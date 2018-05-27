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
use GuzzleHttp\ClientInterface;
use JMS\Serializer\Serializer;
use JMS\SerializerBundle\JMSSerializerBundle;
use Lamsa\RequestHandler\Middleware\GuzzleRequestHandler;
use Lamsa\RequestHandler\Request;
use Lamsa\RequestHandler\RequestHandler;
use Lamsa\RequestHandler\RequestHandlerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class RequestHandlerTest extends TestCase
{
    /**
     * @var ClientInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $guzzle;

    /**
     * @var RequestHandlerInterface
     */
    private $guzzleRequestHandler;

    /**
     * @var EventDispatcherInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $eventDispatcherMock;

    /**
     * @var Serializer $serializer
     */
    private $serializer;

    /**
     * @inheritDoc
     */
    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->eventDispatcherMock  = $this->getMockBuilder(EventDispatcherInterface::class)->getMock();
        $this->guzzle               = new Client();
        $this->serializer           = $this->getMockBuilder(Serializer::class)->disableOriginalConstructor()->getMock();
        $this->guzzleRequestHandler = new GuzzleRequestHandler(new Client(),$this->serializer);
    }

    /**
     *
     */
    public function testHandleRequest() {

        $request = new Request('get',"http://ip-api.com/json/");
        $request->setHeader('Content-Type','application/json');
//        $request->setBody("dsdsds");

        $requestHandler = new RequestHandler($this->eventDispatcherMock,$this->guzzleRequestHandler);
        $response = $requestHandler->handle($request);
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
    }
}