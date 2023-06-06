<?php

namespace App\Controller;

use App\Form\RechercheType;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    #[Route('/' ,name: 'app_index')]
    public function index(CategorieRepository $catRepository,PlatRepository $platRepository,Request $request): Response
    {
        $cat=$catRepository->findMany(6);        
        $plat=$platRepository->findMany(3);


        $form = $this->createForm(RechercheType::class);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $recherche = $form->getData();
 
            if($catRepository->findOneBy(['libelle' => $recherche])){ 
                $categorie = $catRepository->findOneBy(['libelle' => $recherche]);
                return $this->redirectToRoute('app_catplat', ['categorie' => $categorie->getId()]);
            }

            if($platRepository->findOneBy(['libelle' => $recherche])){ 
                $plat = $platRepository->findOneBy(['libelle' => $recherche]);
                return $this->redirectToRoute('app_detailplat', ['plat' => $plat->getId()]);
            }
        };

        return $this->render('index/index.html.twig', [
          'cats'=>$cat,

          'plats'=>$plat,

          'form'=>$form->createView(),
        ]);
    }
    
}
