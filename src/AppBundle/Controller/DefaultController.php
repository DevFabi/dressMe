<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Schedule;
use AppBundle\Form\ScheduleType;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="rdv")
     */
    public function indexAction(Request $request)
    {
        $schedule = new Schedule();
        $form = $this->createForm(ScheduleType::class, $schedule);

 if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($schedule);
            $em->flush(); 
$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            return $this->redirectToRoute('rdv'); // Redirige vers la page
    }
        return $this->render('default/index.html.twig', array('form' => $form->createView(), 
    ));

    }

    /**
     * Edite un évenement par glissement
     * @param Request $request
     * @return Response
     */
    public function dropEventAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $idEvent = $request->request->get('id');
            $startDate = $request->request->get('start');
            $endDate = $request->request->get('end');
 
            $em = $this->getDoctrine()->getManager();
            $rst = $em->getRepository('AppBundle:Schedule')->dropEvent($idEvent,$startDate,$endDate);
 
        }
 
        return new Response("Erreur.");
    }

     /**
     * Suppression d'un évenement
     * @param Request $request
     * @return Response
     */
    public function deleteEventAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $idEvent = $request->request->get('id');
             
            $em = $this->getDoctrine()->getManager();
            $rst = $em->getRepository('AppBundle:Schedule')->deleteEvent($idEvent);
 
        }
 
        return new Response("Erreur.");
    }

 
    /**
     * Edite un évenement par son titre et commentaire
     * @param Request $request
     * @return Response
     */
    public function editEventAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $idEvent = $request->request->get('id');
            $title = $request->request->get('title');
 
            $em = $this->getDoctrine()->getManager();
            $rst = $em->getRepository('AppBundle:Schedule')->editEvent($idEvent, $title);
 
        }
 
        return new Response("Erreur.");
    }
}