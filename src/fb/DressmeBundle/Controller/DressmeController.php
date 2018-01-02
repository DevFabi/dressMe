<?php

namespace fb\DressmeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use fb\DressmeBundle\Entity\Client;
use fb\DressmeBundle\Form\ClientType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DressmeController extends Controller
{
    public function indexAction()
    {
        return $this->render('DressmeBundle:Dressme:index.html.twig');
    }
        public function loginAction()
    {
        return $this->render('DressmeBundle:Dressme:login.html.twig');
    }
        public function homeAction()
    {
        return $this->render('DressmeBundle:Dressme:home.html.twig');
    }
        public function profilAction()
    {
        return $this->render('DressmeBundle:Dressme:profil.html.twig');
    }
     public function encaissementAction()
    {
        return $this->render('DressmeBundle:Dressme:encaissement.html.twig');
    }
    public function clientsAction(Request $request)
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
    //Affiche le formulaire en le récupérant de clientType//
    // NE PAS OUBLIER D'AJOUTER LES USE//
 if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush(); // Rentre tout dans la bdd
            return $this->redirectToRoute('clients'); // Redirige vers la page
    }
        return $this->render('DressmeBundle:Dressme:clients.html.twig', array('form' => $form->createView(), // Sinon on réactualise le formulaire
    ));
    }
     public function prestationsAction()
    {
        return $this->render('DressmeBundle:Dressme:prestations.html.twig');
    }    
}
