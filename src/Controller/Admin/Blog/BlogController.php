<?php

namespace App\Controller\Admin\Blog;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("dashboard/articles")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog_index", methods={"GET"})
     */
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('admin/blog/articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="blog_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $image = $form->get('imageArticle')->getData();
            if($image){
                $fichier = $this->slugify($form->get('titre')->getData()).'.'.$image->guessExtension();
                $image->move(
                    $this->getParameter('app.path.blog_images'),
                    $fichier
                );
                $article->setImageArticle($fichier);
            }
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/blog/articles/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="blog_show", methods={"GET"})
     */
    public function show(Articles $article): Response
    {
        return $this->render('admin/blog/articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="blog_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Articles $article): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_delete", methods={"POST"})
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blog_index', [], Response::HTTP_SEE_OTHER);
    }

    public  function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
