<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/detailexport")
     */
    class ExportOrderDetailController extends AbstractController
    {
        private ProductRepository $repo;
        public function __construct(ProductRepository $repo)
       {
          $this->repo = $repo;
       }
        
        /**
         * @Route("/", name="exproduct_show")
         */
        public function readAllProAction(): Response
        {
            $products = $this->repo->findAll();
            return $this->render('export_order_detail/index.html.twig', [
                'products'=>$products
            ]);
        }
    }