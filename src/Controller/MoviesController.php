<?php
// src/Controller/MoviesController.php

namespace App\Controller;

use App\Entity\Movies;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MoviesController extends AbstractController
{
    /**
     * @Route("/", name="movies")
     */
    public function index()
    {
        $movies = $this->getDoctrine()
            ->getRepository(Movies::class)
            ->findBy([], ['name'=>'ASC'], 18, 0);

        dump($movies[0]->getCategory());

        return $this->render('movies/index.html.twig', [
            'controller_name' => 'MoviesController',
            'movies' => $movies,
        ]);
    }
}
