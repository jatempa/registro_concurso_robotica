<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;

class CarreraRestController extends Controller
{
    /**
     * @Get("/careers")
     */
    public function getCarrerasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carreras = $em->getRepository('AppBundle:Carrera')->findAll();

        $view = View::create()->setData(array('carreras' => $carreras));

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}
