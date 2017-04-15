<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="convocatoria")
     */
    public function convocatoriaAction()
    {
        return $this->render('default/index.html.twig');
    }
 
    /**
     * @Route("/registrar/equipo", name="registro")
     */
    public function registroAction()
    {
        return $this->render('default/registro.html.twig');
    }
}
