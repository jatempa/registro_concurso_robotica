<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EquipoRestController extends Controller
{
    /**
     * @Post("/registro/equipo/nuevo")
     */
    public function postRegistroEquipoAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
//            $respuesta = "OK-Nasdasduevo";

            return new JsonResponse($request->headers->get('X-Requested-With'));
        }

        return new Response('This is not ajax!', 400);
    }
}