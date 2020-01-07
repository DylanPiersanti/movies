<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Categories;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findBy([], ['name'=>'ASC']);

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }


    /**
     * @Route("/categories/{id}", name="categorie")
     */

    public function categorie($id, Request $request, PaginatorInterface $paginator)
    {   
        $categorie = $this->getDoctrine()
            -> getRepository(Categories::class)
            -> find($id);

        $categorieList = $paginator->paginate(
            $categorie->getMovies(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('/categories/categorie.html.twig', [
            'categorieList' => $categorieList,
        ]);
    }
}
