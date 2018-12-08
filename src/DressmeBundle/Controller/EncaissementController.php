<?php

namespace DressmeBundle\Controller;

use DressmeBundle\Entity\Encaissement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Encaissement controller.
 *
 */
class EncaissementController extends Controller
{
    /**
     * Lists all encaissement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $encaissements = $em->getRepository('DressmeBundle:Encaissement')->findAll();

        return $this->render('@Dressme/Dressme/encaissement/index.html.twig', array(
            'encaissements' => $encaissements,
        ));
    }

    /**
     * Creates a new encaissement entity.
     *
     */
    public function newAction(Request $request)
    {
        $encaissement = new Encaissement();
        $form = $this->createForm('DressmeBundle\Form\EncaissementType', $encaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($encaissement);
            $em->flush();

            return $this->redirectToRoute('encaissement', array('id' => $encaissement->getId()));
        }

        return $this->render('@Dressme/Dressme/encaissement/new.html.twig', array(
            'encaissement' => $encaissement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a encaissement entity.
     *
     */
    public function showAction(Encaissement $encaissement)
    {
        $deleteForm = $this->createDeleteForm($encaissement);

        return $this->render('@Dressme/Dressme/encaissement/show.html.twig', array(
            'encaissement' => $encaissement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing encaissement entity.
     *
     */
    public function editAction(Request $request, Encaissement $encaissement)
    {
        $deleteForm = $this->createDeleteForm($encaissement);
        $editForm = $this->createForm('DressmeBundle\Form\EncaissementType', $encaissement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('encaissement_edit', array('id' => $encaissement->getId()));
        }

        return $this->render('@Dressme/Dressme/encaissement/edit.html.twig', array(
            'encaissement' => $encaissement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a encaissement entity.
     *
     */
    public function deleteAction(Request $request, Encaissement $encaissement)
    {
        $form = $this->createDeleteForm($encaissement);
        $form->handleRequest($request);

        
            $em = $this->getDoctrine()->getManager();
            $em->remove($encaissement);
            $em->flush();
        

        return $this->redirectToRoute('encaissement');
    }

    /**
     * Creates a form to delete a encaissement entity.
     *
     * @param Encaissement $encaissement The encaissement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Encaissement $encaissement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('encaissement_delete', array('id' => $encaissement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
