<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Equipo;

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
}
