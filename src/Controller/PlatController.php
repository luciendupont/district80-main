<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\httpfoundation\file\UploadedFile;


class PlatController extends AbstractController
{
    #[Route('/plat', name: 'app_plat')]
    public function plat(PlatRepository $platRepository,  PaginatorInterface $paginator, Request $request): Response
    {
        $plat = $paginator->paginate(
            $platRepository->findAll(),
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('plat/index.html.twig', [
         'plats'=>$plat
        ]);
    }

    #[Route('/detail/{plat}',name:'app_detailplat')]
    public function detail(Plat $plat)

    {

        return $this->render('plat/detail.html.twig',[
            'plat'=>$plat
        ]);
    }

    #[Route('/nouveauplat',name:'app_nouveauplat')]
    public function nouveau(Request $request,EntityManagerInterface $entityManagerInterface)
    { $plat=new Plat();
        $form=$this->createForm(PlatType::class,$plat);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $plat=$form->getData();
            $entityManagerInterface->persist($plat);
            $entityManagerInterface->flush();

        }
        return $this ->render('plat/nouveau.html.twig',[
                'form'=>$form->createView()
        ]);
    }
}
