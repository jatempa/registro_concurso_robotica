<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Equipo;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
 
    /**
     * @Route("/registrar/equipo", name="convocatoria")
     */
    public function convocatoriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $equipos = $em->getRepository('AppBundle:Equipo')->findEquipos();
        // replace this example code with whatever you need
        return $this->render('default/convocatoria_cerrada.html.twig', array('equipos' => $equipos));
    }

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
