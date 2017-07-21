<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="convocatoria")
     * @Method("GET")
     */
    public function convocatoriaAction()
    {
        return $this->render('default/convocatoria.twig');
    }
 
    /**
     * @Route("/registro", name="registro")
     * @Method("GET")
     */
    public function registroAction()
    {
        return $this->render('default/registro.html.twig');
    }
}
