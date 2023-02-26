<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExportDetailController extends AbstractController
{
    /**
     * @Route("/export/detail", name="app_export_detail")
     */
    public function index(): Response
    {
        return $this->render('export_detail/index.html.twig', [
            'controller_name' => 'ExportDetailController',
        ]);
    }
}
