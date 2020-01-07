<?php

namespace App\Controller;

use App\Entity\Authors;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorsController extends AbstractController
{
    /**
     * @Route("/authors", name="authors")
     */
    public function index()
    {

        $authors = $this->getDoctrine()
            ->getRepository(Authors::class)
            ->findBy([], ['name'=>'ASC'], 18, 0);

        return $this->render('authors/index.html.twig', [
            'controller_name' => 'AuthorsController',
            'authors' => $authors
        ]);
    }

    /**
     * @Route("/author/{id}", name="author")
     */

    public function currentAuthor($id)
    {   
        $author = $this->getDoctrine()
            -> getRepository(Authors::class)
            -> find($id);

        return $this->render('author/index.html.twig', [
            'author' => $author,
        ]);
    }
}
