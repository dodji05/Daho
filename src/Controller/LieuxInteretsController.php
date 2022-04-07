<?php

namespace App\Controller;

use App\Entity\LieuxInterets;
use App\Form\LieuxInteretsType;
use App\Entity\ImagesLieuxInterets;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LieuxInteretsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/dashboard/lieux-interets")
 */
class LieuxInteretsController extends AbstractController
{
    /**
     * @Route("/", name="app_lieux_interets_index", methods={"GET"})
     */
    public function index(LieuxInteretsRepository $lieuxInteretsRepository): Response
    {
        return $this->render('lieux_interets/index.html.twig', [
            'lieux_interets' => $lieuxInteretsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_lieux_interets_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lieuxInteret = new LieuxInterets();
        $form = $this->createForm(LieuxInteretsType::class, $lieuxInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lieuxInteret);

            $images = $form->get('img')->getData();
          
                    foreach ($images as $image) {
                        // On génère un nouveau nom de fichier
                        $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            
                        // On copie le fichier dans le dossier uploads
                        $image->move(
                            $this->getParameter('lieux'),
                            $fichier
                        );
                    // On crée l'image dans la base de données
            
                    $imgs = new ImagesLieuxInterets();
                    $imgs->setLieuinteret($lieuxInteret);
                   $imgs->setUrl($fichier);
                    $entityManager->persist($imgs);
                    } 

            $entityManager->flush();
            
            $this->addFlash("sucess",'Le lieux d\'interet a été enregistré avec sucess');
            return $this->redirectToRoute('app_lieux_interets_show', ["id"=>$lieuxInteret->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lieux_interets/new.html.twig', [
            'lieux_interet' => $lieuxInteret,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_lieux_interets_show", methods={"GET"})
     */
    public function show(LieuxInterets $lieuxInteret): Response
    {
        return $this->render('lieux_interets/show.html.twig', [
            'lieux_interet' => $lieuxInteret,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_lieux_interets_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, LieuxInterets $lieuxInteret, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LieuxInteretsType::class, $lieuxInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lieux_interets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lieux_interets/edit.html.twig', [
            'lieux_interet' => $lieuxInteret,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_lieux_interets_delete", methods={"POST"})
     */
    public function delete(Request $request, LieuxInterets $lieuxInteret, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lieuxInteret->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lieuxInteret);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lieux_interets_index', [], Response::HTTP_SEE_OTHER);
    }
}
