<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api_main)
     */

     public function apiController()
     {
         $resp = array(
             'response' => 'No API Call',
         );

         return new JsonResponse($resp);
     }

     /**
     * @Route("/api/email", name="api_email)
     * @Method("POST")
     */
     private function emailController()
     {
        return new Response("email API");
     }
}