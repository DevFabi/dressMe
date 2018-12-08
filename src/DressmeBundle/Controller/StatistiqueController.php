<?php

namespace DressmeBundle\Controller;

use DressmeBundle\Entity\Encaissement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class StatistiqueController extends Controller
{
 
    public function statistiqueAction()
    {
       
  
        $em = $this->getDoctrine()->getManager();

        // Nb prestations en mai 2018
        $encaissementsMai = $em->getRepository('DressmeBundle:Encaissement')->prestationMai();
        
        $bestPrestation = $em->getRepository('DressmeBundle:Encaissement')->bestPrestation();
        print_r($bestPrestation[0]);
        //'bestPrestation' => $bestPrestation


        return $this->render('@Dressme/Dressme/statistique.html.twig', array(
            'encaissement' => $encaissementsMai));
    }

    public function pdfAction()
    {
        $html = $this->render('@Dressme/Dressme/pdf.html.twig');

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }

}
