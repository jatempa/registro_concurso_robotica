<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;

class RoboticaRestController extends Controller
{
    /**
     * @Get("/carreras")
     */
    public function getCarreraAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carreras = $em->getRepository('AppBundle:Carrera')->findAll();

        $view = View::create()->setData(array('carreras' => $carreras));

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}

