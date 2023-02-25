<?php

namespace App\Controller;

use App\Entity\ImportOrder;
use App\Entity\ImportOrderDetail;
use App\Form\ImportDetailType;
use App\Repository\ImportOrderDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/detail")
     */
class ImportDetailController extends AbstractController
{

    private ImportOrderDetailRepository $repo;
    public function __construct(ImportOrderDetailRepository $repo)
   {
      $this->repo = $repo;
   }

   /**
     * @Route("/{id}", name="importdetail_show")
     */
    
        // $ims = $this->repo->findAll();
        // return $this->render('import_detail/index.html.twig', [
        //     'imdetails'=>$ims
        // ]);
        public function fillOrder(ImportOrder $cateid): Response
      {
        $ims = $this->repo->fillOrderById($cateid);
         return $this->render('import_detail/index.html.twig', [
                'imdetails'=>$ims]);
        
      }

    /**
     * @Route("/{id}", name="imdetail",requirements={"id"="\d+"})
     */
    public function addProdAction(Request $req, ImportOrderDetail $detail, string $id): Response
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

    /**
     * @Route("/{id}", name="imdetail_read",requirements={"id"="\d+"})
     */
    public function showAction(ImportOrder $p): Response
    {
        return $this->render('detail.html.twig', [
            'p'=>$p
        ]);
    }
}
