<?php

namespace App\Controller\Admin\Blog;

use App\Entity\CategoriesArticles;
use App\Form\CategoriesArticlesType;
use App\Repository\CategoriesArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("dashboard/articles/categories")
 */
class CategoriesArticlesController extends AbstractController
{
    /**
     * @Route("/", name="categories_articles_index", methods={"GET","POST"})
     */
    public function index(Request $request, CategoriesArticlesRepository $categoriesArticlesRepository): Response
    {
        $categoriesArticle = new CategoriesArticles();
        $form = $this->createForm(CategoriesArticlesType::class, $categoriesArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoriesArticle);
            $entityManager->flush();
            $this->addFlash('success', "la catégorie : " . $categoriesArticle->getNom() . " ajouté avec succes");
            return $this->redirectToRoute('categories_articles_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('admin/blog/categories_articles/index.html.twig', [
            'categories_articles' => $categoriesArticlesRepository->findAll(),
            'categories_article' => $categoriesArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="categories_articles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoriesArticle = new CategoriesArticles();
        $form = $this->createForm(CategoriesArticlesType::class, $categoriesArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoriesArticle);
            $entityManager->flush();

            return $this->redirectToRoute('categories_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/blog/categories_articles/new.html.twig', [
            'categories_article' => $categoriesArticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="categories_articles_show", methods={"GET"})
     */
    public function show(CategoriesArticles $categoriesArticle): Response
    {
        return $this->render('admin/blog/categories_articles/show.html.twig', [
            'categories_article' => $categoriesArticle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categories_articles_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, CategoriesArticles $categoriesArticle): Response
    {
        $form = $this->createForm(CategoriesArticlesType::class, $categoriesArticle);
        $form->handleRequest($request);


        if ($this->handleEditForm($request, $categoriesArticle, $form)) {
            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(array(
                    'success' => true,
                ));
            } else {
//                return $this->redirectToRoute('app_autoecole_show', array('id' => $autoEcole->getId()));
                return $this->redirectToRoute('categories_articles_edit');
            }
        }

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success' => false,
                'errors' => $form->getErrors(true),

            ]);
        } else {
            return $this->render('admin/blog/categories_articles/_form.html.twig', [
                'categories_article' => $categoriesArticle,
                'form' => $form->createView(),
            ]);
        }

     /*   if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categories_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/blog/categories_articles/edit.html.twig', [
            'categories_article' => $categoriesArticle,
            'form' => $form,
        ]);*/
    }

    /**
     * @Route("/{id}", name="categories_articles_delete", methods={"POST"})
     */
    public function delete(Request $request, CategoriesArticles $categoriesArticle): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categoriesArticle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoriesArticle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_articles_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/create-form", name="categories_articles_ajax_edit",options={"expose"=true})
     */
    public function ajaxEditFormAction(Request $request, CategoriesArticles $categorie)
    {
        $editForm = $this->createForm(CategoriesArticlesType::class, $categorie);

        return $this->render('admin/blog/categories_articles/_form.html.twig', array(
            'categories_article' => $categorie,
            'isModal' => true,
            'single' => true,
            'form' => $editForm->createView(),
        ));
    }

    public function handleEditForm(Request $request, $bonsplans, $form)
    {


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //$entity = $form->getData();

            $em->persist($bonsplans);
            $em->flush();

            return true;
        }

        return false;
    }
}
