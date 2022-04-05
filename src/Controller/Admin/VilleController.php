<?php

namespace App\Controller\Admin;

use App\Entity\Ville;
use App\Entity\ImageVille;
use App\Form\VilleType;
use App\Form\ImageVilleType;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("dashboard/ville")
 */
class VilleController extends AbstractController
{
    /**
     * @Route("/", name="ville_index", methods={"GET"})
     */
    public function index(VilleRepository $villeRepository): Response
    {
        return $this->render('admin/ville/index.html.twig', [
            'villes' => $villeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ville_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $images = $form->get('img')->getData();

            foreach ($images as $image) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('villes'),
                    $fichier
                );
            // On crée l'image dans la base de données

            $imagesVille = new ImageVille();
            $imagesVille->setVille($ville);
           $imagesVille->setUrl($fichier);
            $entityManager->persist($imagesVille);
            }

           
            $entityManager->persist($ville);
            $entityManager->flush();

            return $this->redirectToRoute('ville_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/ville/new.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ville_show", methods={"GET"})
     */
    public function show(Request $request,Ville $ville): Response
    {
        $imagevil = new ImageVille();
    $form = $this->createForm(ImageVilleType::class, $imagevil);
    $form->handleRequest($request);
  
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $images = $form->get('img')->getData();
dd($images);
        foreach ($images as $image) {
            // On génère un nouveau nom de fichier
            $fichier = md5(uniqid()) . '.' . $image->guessExtension();

            // On copie le fichier dans le dossier uploads
            $image->move(
                $this->getParameter('villes'),
                $fichier
            );
        // On crée l'image dans la base de données

        $imagesVille = new ImageVille();
        $imagesVille->setVille($ville);
       $imagesVille->setUrl($fichier);
        $entityManager->persist($imagesVille);
        }       
       
        $entityManager->flush();

        return $this->redirectToRoute('ville_index', [], Response::HTTP_SEE_OTHER);
    }

        return $this->render('admin/ville/show.html.twig', [
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ville_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ville $ville): Response
    {
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ville_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ville/edit.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    /**
     * @Route("image/{id}/add", name="ville_ajout_image", methods={"POST"})
     */
  public function addImages (Request $request, Ville $ville){
    $image = new ImageVille();
    $form = $this->createForm(ImageVilleType::class, $image);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $images = $form->get('img')->getData();

        foreach ($images as $image) {
            // On génère un nouveau nom de fichier
            $fichier = md5(uniqid()) . '.' . $image->guessExtension();

            // On copie le fichier dans le dossier uploads
            $image->move(
                $this->getParameter('villes'),
                $fichier
            );
        // On crée l'image dans la base de données

        $imagesVille = new ImageVille();
        $imagesVille->setVille($ville);
       $imagesVille->setUrl($fichier);
        $entityManager->persist($imagesVille);
        }       
       
        $entityManager->flush();

        return $this->redirectToRoute('ville_index', [], Response::HTTP_SEE_OTHER);
    }
    return $this->renderForm('admin/ville/new.html.twig', [
        'image' => $image,
        'form' => $form,
    ]);

  }
   /**
     * @Route("image/{id}/supprimer", name="ville_delete_image", methods={"POST"})
     */
    public function dellImages (Request $request, ImageVille $image ){
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ville_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{id}", name="ville_delete", methods={"POST"})
     */
    public function delete(Request $request, Ville $ville): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ville);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ville_index', [], Response::HTTP_SEE_OTHER);
    }
}
