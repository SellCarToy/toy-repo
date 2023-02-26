<?php

namespace App\Controller;


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
        public function fillOrder(ImportOrderDetail $cateid): Response
      {
        // $ims = $this->repo->findAll();
        // return $this->render('import_detail/index.html.twig', [
        //     'imdetails'=>$ims
        // ]);
        $ims = $this->repo->fillOrderById($cateid);
         return $this->render('import_detail/index.html.twig', [
                'imdetails'=>$ims]);
        
      }

    /**
     * @Route("/im", name="imdetail",requirements={"id"="\d+"})
     */
    public function addProdAction(Request $req): Response
    {
        // $det = $this->repo->addProduct($id);
        $detail = new ImportOrderDetail();
        $form = $this->createForm(ImportDetailType::class, $detail);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
           
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
    // public function showAction(ImportOrder $p): Response
    // {
    //     return $this->render('detail.html.twig', [
    //         'p'=>$p
    //     ]);
    // }
}
