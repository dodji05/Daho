<?php

namespace App\Controller\Admin;

use App\Entity\CategorieLieuxInterets;
use App\Form\CategorieLieuxInteretsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieLieuxInteretsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/dashboard/lieux-interets/categories")
 */
class LieuxInteretsController extends AbstractController
{
    /**
     * @Route("/", name="admin_cat_lieux_interets_index", methods={"GET", "POST"})
     */
    public function index(Request $request, CategorieLieuxInteretsRepository $categorieLieuxInteretsRepository): Response
    {
        $categorieLieuxInteret = new CategorieLieuxInterets();
        $form = $this->createForm(CategorieLieuxInteretsType::class, $categorieLieuxInteret);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorieLieuxInteret);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cat_lieux_interets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/lieux_interets/categorie/index.html.twig', [
            'categorie_lieux_interets' => $categorieLieuxInteretsRepository->findBy(["status"=>true]),
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/desactive/{id}", name="admin_cat_lieux_interets_desactive", methods={"GET","POST"})
     */
    public function desactive(CategorieLieuxInterets $categorieLieuxInteret) {
        $entityManager = $this->getDoctrine()->getManager();
        if($categorieLieuxInteret->getStatus() == false) {
            $categorieLieuxInteret->setStatus(true);
          
            $entityManager->persist($categorieLieuxInteret);
            $entityManager->flush();
            $this->addFlash('success', 'La categorie a été activée avec success');
            return $this->json([
                'code'=>200,
                'status'=>$categorieLieuxInteret->getStatus(),
                'message'=>'La propriete est mis en avant'
            ]);
        }
        else {
            $categorieLieuxInteret->setStatus(false);
          
            $entityManager->persist($categorieLieuxInteret);
            $entityManager->flush();
            $this->addFlash('success', 'La catégorie a été supprimée avec success');
            return $this->json([
                'code'=>200,
                'status'=>$categorieLieuxInteret->getStatus(),
                'message'=>'La propriete n\' est plus en avant'
            ]);
        }
    }

    /**
     * @Route("/new", name="admin_cat_lieux_interets_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieLieuxInteret = new CategorieLieuxInterets();
        $form = $this->createForm(CategorieLieuxInteretsType::class, $categorieLieuxInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieLieuxInteret);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cat_lieux_interets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/lieux_interets/categorie/new.html.twig', [
            'categorie_lieux_interet' => $categorieLieuxInteret,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_cat_lieux_interets_show", methods={"GET"})
     */
    public function show(CategorieLieuxInterets $categorieLieuxInteret): Response
    {
        return $this->render('admin/lieux_interets/categorie/show.html.twig', [
            'categorie_lieux_interet' => $categorieLieuxInteret,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_cat_lieux_interets_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CategorieLieuxInterets $categorieLieuxInteret, EntityManagerInterface $entityManager): Response
    {
         // $form = $this->createForm(RestaurantsType::class, $restaurant);

         $form = $this->createForm(CategorieLieuxInteretsType::class, $categorieLieuxInteret);
       

         if ($this->handleEditForm($request,$categorieLieuxInteret ,$form)) {
             if ($request->isXmlHttpRequest()) {
                 return new JsonResponse(array(
                     'success' => true,
                 ));
             } else {
 //                return $this->redirectToRoute('app_autoecole_show', array('id' => $autoEcole->getId()));
                 return $this->redirectToRoute('admin_categories_index');
             }
         }
 
         if ($request->isXmlHttpRequest()) {
             return new JsonResponse([
                 'success' => false,
                 'errors' => $form->getErrors(true),
 
             ]);
         }
         else {
             return $this->render('admin/lieux_interets/categorie/edit.html.twig', [
                 'categorieLieuxInteret' => $categorieLieuxInteret,
                 'form' => $form->createView(),
             ]);
         }


     /*   $form = $this->createForm(CategorieLieuxInteretsType::class, $categorieLieuxInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_cat_lieux_interets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/lieux_interets/categorie/edit.html.twig', [
            'categorie_lieux_interet' => $categorieLieuxInteret,
            'form' => $form,
        ]);*/
    }

    /**
     * @Route("/{id}", name="admin_cat_lieux_interets_delete", methods={"POST"})
     */
    public function delete(Request $request, CategorieLieuxInterets $categorieLieuxInteret, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieLieuxInteret->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorieLieuxInteret);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_cat_lieux_interets_index', [], Response::HTTP_SEE_OTHER);
    }




    public function handleEditForm(Request $request, $categorieLieuxInteret, $form)
    {


        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //$entity = $form->getData();

            $em->persist($categorieLieuxInteret);
            $em->flush();

            return true;
        }

        return false;
    }

    /**
     * @Route("/{id}/create-form", name="bonsplans_edit",options={"expose"=true})
     */
    public function ajaxEditFormAction(Request $request, CategorieLieuxInterets $categorieLieuxInteret)
    {
        $editForm = $this->createForm(CategorieLieuxInteretsType::class, $categorieLieuxInteret);

        return $this->render('admin/lieux_interets/categorie/edit.html.twig', array(
            'bonsplans' => $categorieLieuxInteret,
            'isModal' => true,
            'single' => true,
            'form' => $editForm->createView(),
        ));
    }
}
