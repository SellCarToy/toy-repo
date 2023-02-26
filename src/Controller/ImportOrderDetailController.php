<?php

namespace App\Controller;

use App\Entity\ImportOrderDetail;
use App\Entity\Product;
use App\Form\ImportDetailType;
use App\Form\ProductType;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ImportOrderDetailRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;

    /**
     * @Route("/detailimport")
     */
class ImportOrderDetailController extends AbstractController
{
    private ProductRepository $repo;
    public function __construct(ProductRepository $repo)
   {
      $this->repo = $repo;
   }
    
    /**
     * @Route("/", name="improduct_show")
     */
    public function readAllProAction(): Response
    {
        $products = $this->repo->findAll();
        return $this->render('import_order_detail/index.html.twig', [
            'products'=>$products
        ]);
    }
    
    /**
     * @Route("/edit/{id}", name="iod_insert",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, Product $p,
    SluggerInterface $slugger): Response
    {  
        $form = $this->createForm(ProductType::class, $p);   
        $form->handleRequest($req);
        return $this->render("import_order_detail/form.html.twig",[
            'form' => $form->createView()
        ]);
    }

    

    // /**
    //  * @Route("/add", name="imorderdetail_create")
    //  */
    // public function importOrderDetail(Request $req, SluggerInterface $slugger): Response
    // {
        
    //     $p = new Product();
    //     $form = $this->createForm(ImporOrdertDetailType::class, $p);

    //     $form->handleRequest($req);
    //     if($form->isSubmitted() && $form->isValid()){
    //         $this->repo->add($p,true);
    //         return $this->redirectToRoute('product_show', [], Response::HTTP_SEE_OTHER);
    //     }
    //     return $this->render("import_order_detail/form.html.twig",[
    //         'form' => $form->createView()
    //     ]);
    // }
    
}

