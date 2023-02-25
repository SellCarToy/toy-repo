<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="searchByName")
     */
    public function searchByNameAction(ProductRepository $repo, Request $req): Response
    {
        $name = $req->query->get('name');
        $prods = $repo->searchByName($name);
        return $this->render('home.html.twig', [
            'products'=>$prods
        ]);
    }
}
