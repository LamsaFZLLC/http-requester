<?php
/**
 * http-requester - JsonResponseListenerTest.php
 *
 * Date: 4/24/18
 * Time: 8:10 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */

namespace Tests\Lamsa\Listener;


use Lamsa\RequestHandler\Event\ResponseEvent;
use Lamsa\RequestHandler\Listener\JsonResponseListener;
use Lamsa\RequestHandler\Response;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class JsonResponseListenerTest extends TestCase
{
    /**
     * @var LoggerInterface
     */
    private $loggerMock;

    protected function setUp()
    {
        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)->getMock();
    }

    /**
     * @throws \Exception
     */
    public function testOnReceivedResponse() {

        $jsonResponseListener = new JsonResponseListener($this->loggerMock);

        $response = new Response(200);
        $response->setHeaders(array('Content-Type' =>['application/json','utf-8']));
        $response->setBody('{"foo": "12345"}');

        $event = new ResponseEvent($response);

        $jsonResponseListener->onReceivedResponse($event);
        $this->assertEquals($response->getBody(),$event->getResponse()->getBody());
    }
}