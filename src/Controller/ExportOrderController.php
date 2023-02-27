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
        private ExportOrderRepository $repo;
    public function __construct(ExportOrderRepository $repo)
   {
      $this->repo = $repo;
   }

   /**
     * @Route("/", name="export_show")
     */
    public function readAllCatAction(): Response
    {
        $exs = $this->repo->totalPrice();
        return $this->render('export_order/index.html.twig', [
            'exports'=>$exs
        ]);
    }
    /**
     * @Route("/add", name="export_create")
     */
    
    public function createEx(Request $req, SluggerInterface $slugger): Response
    {
        
        $e = new ExportOrder();
        $form = $this->createForm(ExportOrderType::class, $e);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $this->repo->add($e,true);
            return $this->redirectToRoute('exdetailadd', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("export_order/form.html.twig",[
            'form' => $form->createView()
        ]);
    }
}
