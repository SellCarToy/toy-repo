<?php

namespace App\Controller;

use App\Entity\ExportOrder;
use App\Form\ExportOrderType;
use App\Repository\ExportOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
/**
     * @Route("/export")
     */
class ExportOrderController extends AbstractController
{
        private ExportOrderRepository $repo1;
    public function __construct(ExportOrderRepository $repo1)
   {
      $this->repo1 = $repo1;
   }
    /**
     * @Route("/", name="export_create")
     */
    
    public function createEx(Request $req, SluggerInterface $slugger): Response
    {
        
        $e = new ExportOrder();
        $form = $this->createForm(ExportOrderType::class, $e);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $this->repo1->add($e,true);
            return $this->redirectToRoute('category_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("export_order/form.html.twig",[
            'form' => $form->createView()
        ]);
    }
}
