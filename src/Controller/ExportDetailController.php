<?php

namespace App\Controller;

use App\Entity\ExportOrder;
use App\Entity\ExportOrderDetail;
use App\Form\ExportDetailType;
use App\Repository\ExportOrderDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
     * @Route("/exdetail")
     */
class ExportDetailController extends AbstractController
{
    private ExportOrderDetailRepository $repo;
    public function __construct(ExportOrderDetailRepository $repo)
   {
      $this->repo = $repo;
   }

    /**
     * @Route("/{id}", name="exportdetail_show")
     */
    
        
        public function fillOrder(ExportOrder $cateid): Response
      {
        $orderDetails = $this->repo->fillOrderByIdEx2($cateid);
        $exs = $this->repo->fillOrderByIdEx1($cateid);
        // return $this->json($ims);
         return $this->render('export_detail/index.html.twig', [
                'exs'=>$exs,
              'orderDetails'=>$orderDetails]);
        
      }

    
    // /**
    //  * @Route("/{id}", name="exdetailadd",requirements={"id"="\d+"})
    //  */
    // public function addProdAction(Request $req, ExportOrderDetail $detail, string $id): Response
    // {
    //     //$id = $this->$this->getDoctrine()->getRepository('ImportDetailController:ImportOrderDetail')->find($imorder);
    //     $form = $this->createForm(ExportDetailType::class, $detail);   

    //     $form->handleRequest($req);
    //     if($form->isSubmitted() && $form->isValid()){
    //         $this->repo->addProduct($id);
    //         $this->repo->add($detail,true);
    //         return $this->redirectToRoute('product_show', [], Response::HTTP_SEE_OTHER);
    //     }
    //     return $this->render("import_detail/form.html.twig",[
    //         'form' => $form->createView()
    //     ]);
    // }
}
