<?php

namespace App\Controller;

use App\Entity\ExportOrderDetail;
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
     * @Route("/export/detail", name="app_export_detail")
     */
    public function index(): Response
    {
        return $this->render('export_detail/index.html.twig', [
            'controller_name' => 'ExportDetailController',
        ]);
    }

    
    /**
     * @Route("/{id}", name="imdetail",requirements={"id"="\d+"})
     */
    public function addProdAction(Request $req, ExportOrderDetail $detail, string $id): Response
    {
        //$id = $this->$this->getDoctrine()->getRepository('ImportDetailController:ImportOrderDetail')->find($imorder);
        $form = $this->createForm(ImportDetailType::class, $detail);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $this->repo->addProduct($id);
            $this->repo->add($detail,true);
            return $this->redirectToRoute('product_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("import_detail/form.html.twig",[
            'form' => $form->createView()
        ]);
    }
}
