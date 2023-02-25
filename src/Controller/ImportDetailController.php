<?php

namespace App\Controller;

use App\Entity\ImportOrderDetail;
use App\Entity\Product;
use App\Form\ImportDetailType;
use App\Repository\ImportOrderDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/import/detail")
     */
class ImportDetailController extends AbstractController
{

    private ImportOrderDetailRepository $repo;
    public function __construct(ImportOrderDetailRepository $repo)
   {
      $this->repo = $repo;
   }
    /**
     * @Route("/{id}", name="imdetail",requirements={"id"="\d+"})
     */
    public function addProdAction(Request $req, ImportOrderDetail $detail, string $id): Response
    {
        
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
