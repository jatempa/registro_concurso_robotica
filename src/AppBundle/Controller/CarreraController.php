<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CarreraController extends Controller
{
    /**
     * @Route("/admin/exportarCarreras", name="exportar_carreras_excel")
     * @Method("GET")
     */
    public function exportarCarrerasExcelAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $carreras = $em->getRepository('AppBundle:Carrera')->findCarreras();

        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("Admin")
            ->setTitle("Carreras")
            ->setSubject("Carreras");

        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A1', "Nombre");

        for ($i=0; $i < count($carreras); $i++) {
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A'.((string)$i+2), $carreras[$i]['nombre']);
        }

        // Dimensions
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        $phpExcelObject->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        // Style
        $phpExcelObject->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
        $phpExcelObject->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'carreras.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }
}