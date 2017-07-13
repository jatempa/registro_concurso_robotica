<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;

class AsesorRestController extends Controller
{
    /**
     * @Get("/asesores")
     */
    public function getAsesoresAction()
    {
        $em = $this->getDoctrine()->getManager();

        $asesores = $em->getRepository('AppBundle:Asesor')->findAll();

        $view = View::create()->setData(array('asesores' => $asesores));

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}

