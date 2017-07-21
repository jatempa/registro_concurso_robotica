<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AsesorRestController extends Controller
{
    /**
     * @Get("/asesors")
     */
    public function getAsesoresAction()
    {
        $em = $this->getDoctrine()->getManager();

        $asesores = $em->getRepository('AppBundle:Asesor')->findAll();

        $view = View::create()->setData(array('asesores' => $asesores));

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}

