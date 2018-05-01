<?php
/**
 * http-requester - RequestHandlerInterface.php
 *
 * Date: 4/18/18
 * Time: 12:23 PM
 * @author    Abdelhameed Alasbahi <abdkwa92@gmail.com>
 * @copyright Copyright (c) 2018 LamsaWorld (http://www.lamsaworld.com/)
 */
namespace Lamsa\RequestHandler;

/**
 * Interface RequestHandlerInterface
 * @package Lamsa\RequestHandler
 */
interface RequestHandlerInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request);
}
