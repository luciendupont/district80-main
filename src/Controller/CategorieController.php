<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\httpfoundation\file\UploadedFile;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function categorie(CategorieRepository $categoriripo,  PaginatorInterface $paginator, Request $request): Response
    {
        $cat = $paginator->paginate(
            $categoriripo->findAll(),
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('categorie/index.html.twig', [
            'cats'=>$cat
        ]);
    }

    #[Route('/categorie/{categorie}',name:'app_catplat')]
    public function liste(Categorie $categorie): Response
    {
        return $this->render('categorie/list.html.twig', [
            'cat' => $categorie
            
        ]);
    }


    #[Route('/nouvellecategorie',name:'app_nouvellecategorie')]
    public function nouveau(Request $request,EntityManagerInterface $entityManagerInterface)
    { $categorie=new Categorie();
        $form=$this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $plat=$form->getData();
            $entityManagerInterface->persist($categorie);
            $entityManagerInterface->flush();

        }
        return $this ->render('categorie/nouveau.html.twig',[
                'form'=>$form->createView()
        ]);
    }
    
}
