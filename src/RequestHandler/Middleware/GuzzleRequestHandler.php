<?php
/**
 * http-requester - GuzzleRequestHandler.php
 *
 * Date: 4/18/18
 * Time: 12:23 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */
namespace Lamsa\RequestHandler\Middleware;

use GuzzleHttp\ClientInterface;
use Lamsa\RequestHandler\Exception\RequestHandlerException;
use Lamsa\RequestHandler\Request;
use Lamsa\RequestHandler\RequestHandlerInterface;
use Lamsa\RequestHandler\Response;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;


/**
 * Class GuzzleRequestHandler
 * @package Lamsa\RequestHandler\Middleware
 */
class GuzzleRequestHandler implements RequestHandlerInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * GuzzleRequestHandler constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws RequestHandlerException
     */
    public function handle(Request $request): Response
    {
        try{
            $guzzleResponse = $this->client->request($request->getMethod(),$request->getUri(),
                array(
                'headers' => $request->getHeaders(),
                'body' => $request->getBody())
            );
        }catch (GuzzleException $e){
            throw new RequestHandlerException();
        }
        $response = $this->validateResponse($guzzleResponse);
        return $response;
    }

    /**
     * @param ResponseInterface $guzzleResponse
     * @return Response
     */
    public function validateResponse(ResponseInterface $guzzleResponse) :Response
    {
        $response = new Response($guzzleResponse->getStatusCode());

        if($this->isSuccessful($response)) {

            $response = new Response($guzzleResponse->getStatusCode());
            $response
                ->setHeaders($guzzleResponse->getHeaders())
                ->setBody($guzzleResponse->getBody()->__toString());
        }

        return $response;
    }

    /**
     * @param Response $response
     *
     * @return bool
     */
    public function isSuccessful(Response $response): bool
    {
        return $response->getStatusCode() < Response::HTTP_BAD_REQUEST;
    }
}
