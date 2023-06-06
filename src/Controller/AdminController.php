<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use App\Repository\UserRepository;
use App\Repository\CommandeRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/categorie',name:'app_admincategorie')]
    public function categorie(CategorieRepository $categorieRepository):Response
    {
        $categorie=$categorieRepository->findAll();
        return $this ->render('admin/categorieadmin.html.twig',[
            'cats'=>$categorie
        ]

        );
    }

    #[Route('/admin/plat',name:'app_adminplat')]
    public function Plat(PlatRepository $platRepository):Response
    {
        $plat=$platRepository->findAll();
        return $this ->render('admin/platadmin.html.twig',[
            'plats'=>$plat
        ]
        );
    }

    #[Route('/commande',name:'app_admincommande')]
    public function commande(CommandeRepository $commandeRepository):Response
    {
        $commande=$commandeRepository->findAll();
        return $this ->render('commande/index.html.twig',[
            'commandes'=>$commande
        ]
        );
    }

        #[Route('/admin/user',name:'app_adminuser')]
        public function user(userRepository $UserRepository):Response
        {
            $user=$UserRepository->findAll();
            return $this ->render('admin/useradmin.html.twig',[
                'users'=>$user
            ]
    
        
        );
    }



}
