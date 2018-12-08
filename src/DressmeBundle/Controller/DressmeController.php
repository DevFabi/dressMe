<?php

namespace DressmeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DressmeBundle\Entity\Client;
use src\AppBundle\Entity\Schedule;
use src\AppBundle\Repository\ScheduleRepository;
use DressmeBundle\Form\ClientType;
use DressmeBundle\Entity\Prestation;
use DressmeBundle\Form\PrestationType;
use DressmeBundle\Entity\Encaissement;
use DressmeBundle\Form\EncaissementType;
use DressmeBundle\Entity\Fiche;
use DressmeBundle\Form\FicheType;
use \DateTime;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DressmeController extends Controller
{
    public function indexAction()
    {

    }
        public function loginAction()
    {
        return $this->render('DressmeBundle:Dressme:login.html.twig');
    }
        public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();

        /* MODIFICATION 1 */

        /* Je recupere la date du jour*/
        $datee = new \DateTime('now');
        $startDate = $datee->format('Y-m-d');
        /*var_dump($startDate);*/
        
        /* Appel du repository du calendrier */
         $foundDate = $this->getDoctrine()->getManager()
         ->createQuery(' select e.start from AppBundle:Schedule e WHERE e.start LIKE :start')
         ->setParameter('start', $startDate.'%')
         ->getResult();
       
       /* var_dump($foundDate);*/
    
            
       if (empty($foundDate)) {
            /* Pas de RDV : Pas d'affichage */
        } else{
            $this->addFlash('notice', "Vous avez des rdv aujourd'hui ! ");
        }

         /* FIN MODIFICATION 1 */

        $entitiesLengthC = $em->getRepository('DressmeBundle:Client')->counter();
        $entitiesLengthF = $em->getRepository('DressmeBundle:Fiche')->counter();
        $entitiesLengthE = $em->getRepository('DressmeBundle:Encaissement')->counter();
        $entitiesLengthE = $em->getRepository('DressmeBundle:Encaissement')->counter();
        $entitiesLengthP = $em->getRepository('DressmeBundle:Prestation')->counter();
        return $this->render('DressmeBundle:Dressme:home.html.twig', array(
            'entitiesLengthC' => $entitiesLengthC,
            'entitiesLengthF' => $entitiesLengthF,
            'entitiesLengthE' => $entitiesLengthE,
            'entitiesLengthP' => $entitiesLengthP ));
    }
        public function profilAction()
    {
        return $this->render('DressmeBundle:Dressme:profil.html.twig');
    }
     public function encaissementAction(Request $request)
    {
               /*AFFICHAGE DU FORMULAIRE AJOUT  */
        $encaissement = new Encaissement();
        $form = $this->createForm(EncaissementType::class, $encaissement);
 if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($encaissement);
            $em->flush(); // Rentre tout dans la bdd
            return $this->redirectToRoute('encaissement'); // Redirige vers la page
    }
        /*FIN D'AFFICHAGE DU FORMULAIRE AJOUT*/

        /* APPEL REQUÊTE AFFICHAGE */
             $encaissement = $this->getDoctrine()
        ->getRepository(Encaissement::class)
        ->findEncaissement();
        /* FIN APPEL REQUÊTE AFFICHAGE
        */

        return $this->render('DressmeBundle:Dressme:encaissement.html.twig', array('form' => $form->createView(), // Sinon on réactualise le formulaire
            'encaissement' => $encaissement
    ));
    }
    public function clientsAction(Request $request)
    {
        /*AFFICHAGE DU FORMULAIRE AJOUT  */
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

 if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush(); // Rentre tout dans la bdd
            return $this->redirectToRoute('clients'); // Redirige vers la page
    }
    /*FIN D'AFFICHAGE DU FORMULAIRE AJOUT  */

    /* APPEL REQUÊTE AFFICHAGE */
        $client = $this->getDoctrine()
        ->getRepository(Client::class)
        ->findClient();
    /* FIN APPEL REQUÊTE AFFICHAGE
        */

        return $this->render('DressmeBundle:Dressme:clients.html.twig', array('form' => $form->createView(),
        'client' => $client // Sinon on réactualise le formulaire
    ));
    }
     public function prestationsAction(Request $request)
    {
        /*AFFICHAGE DU FORMULAIRE AJOUT  */
        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
 if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prestation);
            $em->flush(); // Rentre tout dans la bdd
            return $this->redirectToRoute('prestations'); // Redirige vers la page
    }
        /*FIN D'AFFICHAGE DU FORMULAIRE AJOUT*/

        /* APPEL REQUÊTE AFFICHAGE */
        $prestation = $this->getDoctrine()
        ->getRepository(Prestation::class)
        ->findPrestation();
        /* FIN APPEL REQUÊTE AFFICHAGE
        */

        return $this->render('DressmeBundle:Dressme:prestations.html.twig', array('form' => $form->createView(), // Sinon on réactualise le formulaire
            'prestation' => $prestation
    ));
    }    
    public function fichetechniqueAction(Request $request)
    {
         /*AFFICHAGE DU FORMULAIRE AJOUT  */
        $fiche = new Fiche();
        $form = $this->createForm(FicheType::class, $fiche);

 if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            $em->flush(); // Rentre tout dans la bdd
            return $this->redirectToRoute('fichetechnique'); // Redirige vers la page
    }
    /*FIN D'AFFICHAGE DU FORMULAIRE AJOUT  */

    /* APPEL REQUÊTE AFFICHAGE */
        $fiche = $this->getDoctrine()
        ->getRepository(Fiche::class)
        ->findFiche();
    /* FIN APPEL REQUÊTE AFFICHAGE
        */

        return $this->render('DressmeBundle:Dressme:fichetechnique.html.twig', array('form' => $form->createView(),
        'fiche' => $fiche // Sinon on réactualise le formulaire
    ));
    }
}
