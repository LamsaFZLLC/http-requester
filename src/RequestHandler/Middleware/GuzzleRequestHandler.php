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
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
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
     * @var SerializerInterface $serializer
     */
    private $serializer;

    /**
     * GuzzleRequestHandler constructor.
     *
     * @param ClientInterface $client
     * @param Serializer      $serializer
     */
    public function __construct(ClientInterface $client, SerializerInterface $serializer)
    {
        $this->client     = $client;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws RequestHandlerException
     */
    public function handle(Request $request): Response
    {
        $method = $request->getMethod();
        $uri    = $request->getUri();
        $header = $request->getHeaders();
        $body   = $request->getBody();

        if ($method !== 'get' && $method !== 'delete') {
            if (is_object($body)) {
                $body = $this->serializer->serialize($body, 'json');
            }
        }
        $options = $this->getRequestOptions($header, $body);
        try {
            $guzzleResponse = $this->client->request($method, $uri, $options);
        } catch (GuzzleException $e) {
            throw new RequestHandlerException($uri, $e->getMessage());
        }

        return $this->convertGuzzleResponse($guzzleResponse, $request);
    }

    /**
     * @param array       $header
     * @param string|null $body
     *
     * @return array
     */
    private function getRequestOptions(array $header = [], ?string $body = ''): array
    {
        $data = 'body';
        if (is_array($body)) {
            $data = 'form_params';
        }

        return array('headers' => $header, $data => $body);
    }

    /**
     * @param ResponseInterface $guzzleResponse
     *
     * @param Request           $request
     *
     * @return Response
     */
    public function convertGuzzleResponse(ResponseInterface $guzzleResponse, Request $request): Response
    {
        $response = new Response($guzzleResponse->getStatusCode());

        if ($this->isSuccessful($response)) {

            $responseBodyType = $request->getReturnClassName();
            $body             = $guzzleResponse->getBody()->__toString();

            //if class type is defined then mapping to that class will take a place
            if ($responseBodyType) {
                $body = $this->serializer->deserialize($body, $responseBodyType, 'json');
            }
            $response
                ->setHeaders($guzzleResponse->getHeaders())
                ->setBody($body);
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
