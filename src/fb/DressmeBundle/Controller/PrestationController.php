<?php

namespace fb\DressmeBundle\Controller;

use fb\DressmeBundle\Entity\Prestation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Prestation controller.
 *
 */
class PrestationController extends Controller
{
    /**
     * Lists all prestation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $prestations = $em->getRepository('DressmeBundle:Prestation')->findAll();

        return $this->render('@Dressme/Dressme/prestation/index.html.twig', array(
            'prestations' => $prestations,
        ));
    }

    /**
     * Creates a new prestation entity.
     *
     */
    public function newAction(Request $request)
    {
        $prestation = new Prestation();
        $form = $this->createForm('fb\DressmeBundle\Form\PrestationType', $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prestation);
            $em->flush();

            return $this->redirectToRoute('prestation_show', array('id' => $prestation->getId()));
        }

        return $this->render('@Dressme/Dressme/prestation/new.html.twig', array(
            'prestation' => $prestation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a prestation entity.
     *
     */
    public function showAction(Prestation $prestation)
    {
        $deleteForm = $this->createDeleteForm($prestation);

        return $this->render('@Dressme/Dressme/prestation/show.html.twig', array(
            'prestation' => $prestation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing prestation entity.
     *
     */
    public function editAction(Request $request, Prestation $prestation)
    {
        $deleteForm = $this->createDeleteForm($prestation);
        $editForm = $this->createForm('fb\DressmeBundle\Form\PrestationType', $prestation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prestation_edit', array('id' => $prestation->getId()));
        }

        return $this->render('@Dressme/Dressme/prestation/edit.html.twig', array(
            'prestation' => $prestation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a prestation entity.
     *
     */
    public function deleteAction(Request $request, Prestation $prestation)
    {
        $form = $this->createDeleteForm($prestation);
        $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            $em->remove($prestation);
            $em->flush();
        
        return $this->redirectToRoute('prestations');
    }

    /**
     * Creates a form to delete a prestation entity.
     *
     * @param Prestation $prestation The prestation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Prestation $prestation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prestation_delete', array('id' => $prestation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
