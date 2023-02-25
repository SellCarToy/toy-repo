<?php

namespace App\Controller;

use App\Entity\ImportOrder;
use App\Form\ImportOrderType;
use App\Repository\ImportOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImportOrderController extends AbstractController
{
    private ImportOrderRepository $repo;
    public function __construct(ImportOrderRepository $repo)
   {
      $this->repo = $repo;
   }

   /**
     * @Route("/import", name="import_show")
     */
    public function readAllCatAction(): Response
    {
        $ims = $this->repo->findAll();
        return $this->render('import_order/index.html.twig', [
            'imports'=>$ims
        ]);
    }

       /**
     * @Route("/import/add", name="import_create")
     */
    public function createIm(Request $req, SluggerInterface $slugger): Response
    {
        
        $i = new ImportOrder();
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $this->repo->add($i,true);
            return $this->redirectToRoute('imdetail', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("import_order/form.html.twig",[
            'form' => $form->createView()
        ]);
    }
    // /**
    //  * @Route("/", name="import_create")
    //  */
    // public function importOrder(ImportOrderRepository $repo): Response
    // {
    //     $imports = $repo->showImport(1);
    //     return $this->render('import_order/index.html.twig',['imports'=>$imports]);
    //     // return $this->json($products);
    // }

}
