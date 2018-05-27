<?php
/**
 * http-requester - JsonResponseListener.php
 *
 * Date: 4/18/18
 * Time: 12:23 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */
namespace Lamsa\RequestHandler\Listener;

use Exception;
use Lamsa\RequestHandler\Event\ResponseEvent;
use Lamsa\RequestHandler\Response;

/**
 * Class JsonResponseListener
 * @package Lamsa\RequestHandler\Listener
 */
class JsonResponseListener
{
    /**
     * convert json string to json
     * @param ResponseEvent $receivedResponse
     * @throws Exception
     */
    public function onReceivedResponse(ResponseEvent $receivedResponse)
    {
        /*** @var Response $response */
        $response = $receivedResponse->getResponse();

        $contentType = $response->getHeader('Content-Type');
        if (false === strpos($contentType[0], 'application/json')) {
            return;
        }
        $body = $response->getBody();
        if(!empty($body) && !is_object($body)) {
            $json = json_decode($body, true);
            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new Exception("Invalid JSON: $body");
            }
            $response->setBody($json);
        }
    }
}
