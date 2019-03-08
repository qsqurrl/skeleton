<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\InboundEmail;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api_main")
     */

     public function apiController()
     {
         $resp = array(
             'response' => 'No API Call',
         );

         return new JsonResponse($resp);
     }

     /**
     * @Route("/api/email", name="api_email", methods={"POST"})
     */
     public function emailController()
     {
        $entityManager = $this->getDoctrine()->getManager();
        $inemail = new InboundEmail();

        $request = Request::createFromGlobals();
        $topcontent = json_decode($request->getContent(), true);
        $content = json_decode($topcontent['Message'],true);
        
        $inemail->setFromEmail($content['mail']['commonHeaders']['returnPath']);
        $inemail->setFromName($content['mail']['commonHeaders']['from'][0]);
        $inemail->setToEmail($content['mail']['commonHeaders']['to'][0]);
        $inemail->setSubject($content['mail']['commonHeaders']['subject']);

        $response = new Response(dump($content['mail']['commonHeaders']));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(Response::HTTP_NOT_FOUND);

        return $response;
     }
}