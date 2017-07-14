<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class AlumnoController extends Controller
{
    /**
     * @Route("/admin/exportarAlumnos", name="exportar_alumnos_excel")
     * @Method("GET")
     */
    public function exportarAlumnosExcelAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $alumnos = $em->getRepository('AppBundle:Alumno')->findAlumnos();

        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("Admin")
            ->setTitle("Alumnos")
            ->setSubject("Alumnos");

        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A1', "Nombre(s)");
        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('B1', "Apellido Paterno");
        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C1', "Apellido Materno");
        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('D1', "Email");
        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('E1', "Semestre");
        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('F1', "Carrera");

        for ($i=0; $i < count($alumnos); $i++) {
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A'.((string)$i+2), $alumnos[$i]['nombre']);
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('B'.((string)$i+2), $alumnos[$i]['apellidoPaterno']);
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C'.((string)$i+2), $alumnos[$i]['apellidoMaterno']);
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('D'.((string)$i+2), $alumnos[$i]['correoElectronico']);
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('E'.((string)$i+2), $alumnos[$i]['semestre']);
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('F'.((string)$i+2), $alumnos[$i]['carrera']);
        }

        // Dimensions
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        $phpExcelObject->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $phpExcelObject->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $phpExcelObject->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $phpExcelObject->getActiveSheet()->getColumnDimension('D')->setWidth(27);
        $phpExcelObject->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $phpExcelObject->getActiveSheet()->getColumnDimension('F')->setWidth(27);
        // Style
        $phpExcelObject->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
        $phpExcelObject->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
        $phpExcelObject->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
        $phpExcelObject->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
        $phpExcelObject->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
        $phpExcelObject->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
        $phpExcelObject->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'alumnos.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }
}