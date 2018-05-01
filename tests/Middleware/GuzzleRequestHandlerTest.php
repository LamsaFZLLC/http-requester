<?php
/**
 * http-requester - GuzzleRequestHandlerTthp
 *
 * Date: 4/24/18
 * Time: 4:17 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */

namespace Tests\Lamsa\Middleware;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Lamsa\RequestHandler\Middleware\GuzzleRequestHandler;
use Lamsa\RequestHandler\Request;
use PHPUnit\Framework\TestCase;
/**
 * Class GuzzleRequestHandlerTest
 */
class GuzzleRequestHandlerTest extends TestCase
{
    /**
     * @var ClientInterface
     */
    private $guzzle;

    /**
     * @inheritDoc
     */
    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->guzzle = new Client();
    }


    /**
     * @throws \Lamsa\RequestHandler\Exception\RequestHandlerException
     */
    public function testHandleRequest()
    {

        $request = new Request('get', "http://ip-api.com/json/");
        $request->setHeader('Content-Type', 'application/json');
//        $request->setBody("k");

        $guzzleRequestHandler = new GuzzleRequestHandler($this->guzzle);
        $response = $guzzleRequestHandler->handle($request);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
    }
}