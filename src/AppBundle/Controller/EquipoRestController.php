<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Alumno;
use AppBundle\Entity\Asesor;
use AppBundle\Entity\Equipo;
use AppBundle\Entity\Robot;
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
            $result = null;

            $teamName = $request->request->get('team');
            $robotName = $request->request->get('robot');
            $asesorId = $request->request->get('asesor');
            $captainObj = $request->request->get('captain');
            $firstAlumnObj = $request->request->get('firstAlumn');
            $secondAlumnObj = $request->request->get('secondAlumn');

            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                $team = new Equipo();
                $team->setNombre($teamName);

                if(!is_null($robotName)) {
                    // Create Robot
                    $robot = new Robot();
                    $robot->setNombre($robotName);
                    $em->persist($robot);
                    $em->flush();
                    $team->setRobot($robot);
                }

                // Get Asesor
                if (!is_null($asesorId['name']) && !is_null($asesorId['firstLastName']) && !is_null($asesorId['email'])) {
                    $asesor = new Asesor();
                    $asesor->setNombre($asesorId['name']);
                    $asesor->setApellidoPaterno($asesorId['firstLastName']);
                    $asesor->setApellidoMaterno($asesorId['secondLastName']);
                    $asesor->setCorreoElectronico($asesorId['email']);
                    $em->persist($asesor);
                    $em->flush();
                } else if ($asesorId > 0) {
                    $asesor = $em->getRepository('AppBundle:Asesor')->findOneById($asesorId);
                }
                $team->setAsesor($asesor);

                if (!is_null($captainObj)) {
                    // Create Captain
                    $captain = new Alumno();
                    $captain->setNoControl($captainObj['noControl']);
                    $captain->setNombre($captainObj['name']);
                    $captain->setApellidoPaterno($captainObj['firstLastName']);
                    $captain->setApellidoMaterno($captainObj['secondLastName']);
                    $captain->setCorreoElectronico($captainObj['email']);
                    $captain->setSemestre($captainObj['semester']);
                    $captain->setCapitan(true);
                    // Get Career
                    $carrera = $em->getRepository('AppBundle:Carrera')->findOneById($captainObj['selectedCareer']);
                    // Set Career
                    $captain->setCarrera($carrera);
                    $em->persist($captain);
                    $em->flush();
                    $team->addAlumno($captain);
                }

                if (!is_null($firstAlumnObj)) {
                    // Create First Alumn
                    $firstAlumn = new Alumno();
                    $firstAlumn->setNoControl($firstAlumnObj['noControl']);
                    $firstAlumn->setNombre($firstAlumnObj['name']);
                    $firstAlumn->setApellidoPaterno($firstAlumnObj['firstLastName']);
                    $firstAlumn->setApellidoMaterno($firstAlumnObj['secondLastName']);
                    $firstAlumn->setCorreoElectronico($firstAlumnObj['email']);
                    $firstAlumn->setSemestre($firstAlumnObj['semester']);
                    $firstAlumn->setCapitan(false);
                    // Get Career
                    $carrera = $em->getRepository('AppBundle:Carrera')->findOneById($firstAlumnObj['selectedCareer']);
                    // Set Career
                    $firstAlumn->setCarrera($carrera);
                    $em->persist($firstAlumn);
                    $em->flush();
                    $team->addAlumno($firstAlumn);
                }

                if (!is_null($secondAlumnObj)) {
                    // Create Second Alumn
                    $secondAlumn = new Alumno();
                    $secondAlumn->setNoControl($secondAlumnObj['noControl']);
                    $secondAlumn->setNombre($secondAlumnObj['name']);
                    $secondAlumn->setApellidoPaterno($secondAlumnObj['firstLastName']);
                    $secondAlumn->setApellidoMaterno($secondAlumnObj['secondLastName']);
                    $secondAlumn->setCorreoElectronico($secondAlumnObj['email']);
                    $secondAlumn->setSemestre($secondAlumnObj['semester']);
                    $secondAlumn->setCapitan(false);
                    // Get Career
                    $carrera = $em->getRepository('AppBundle:Carrera')->findOneById($secondAlumnObj['selectedCareer']);
                    // Set Career
                    $secondAlumn->setCarrera($carrera);
                    $em->persist($secondAlumn);
                    $em->flush();
                    $team->addAlumno($secondAlumn);
                }
                // Save Team
                $em->persist($team);
                $em->flush();
                $em->getConnection()->commit();
                $result = "OK-Registrado";
            } catch (Exception $e) {
                $em->getConnection()->rollBack();
                throw $e;
            }

            return new JsonResponse($result);
        }

        return new Response('This is not ajax!', 400);
    }
}
