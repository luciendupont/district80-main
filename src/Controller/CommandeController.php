<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/admin/commande', name: 'admin_commande')]
    public function commande(CommandeRepository $ripo): Response
    {
        $commande = $ripo->findAll();
        return $this->render('admin/commande/commande.html.twig', [
            'commandes' => $commande,
        ]);
    
    }

    #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    #[Route('/commande/{commande}', name: 'commande_annulee')]
    public function annulee(User $choosenUser, Commande $commande, EntityManagerInterface $em): Response
    {
        $commande->setEtat(4);
        $em->persist($commande);
        $em->flush();
        return $this->redirectToRoute('app_commande', ['id' => $choosenUser->getId()]);
    }
}