<?php
// src/Controller/MoviesController.php

namespace App\Controller;

use App\Entity\Movies;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;


class MoviesController extends AbstractController
{
    /**
     * @Route("/", name="movies")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $search = (string) $request->query->get('search', null);
        
        $movies = $this->getDoctrine()
            ->getRepository(Movies::class)
            ->createQueryBuilder('m')
            ->where('m.name LIKE :name')
            ->setParameter('name', '%' . $search . '%')
            ->orderBy('m.name')
            ->getQuery()
            ->execute();
            

        $moviesList = $paginator->paginate(
            $movies,
            $request->query->getInt('page', 1),
            6
        );


        return $this->render('movies/index.html.twig', [
            'controller_name' => 'MoviesController',
            'movies' => $movies,
            'moviesList' => $moviesList
        ]);
    }

    /**
     * @Route("/movie/{id}", name="movie")
     */

    public function currentMovie($id)
    {   
        $movie = $this->getDoctrine()
            -> getRepository(Movies::class)
            -> find($id);

        return $this->render('movie/index.html.twig', [
            'movie' => $movie,
        ]);
    }
}
