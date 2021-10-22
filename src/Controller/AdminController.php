<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function indexAction(EntityManagerInterface $em): Response
    {
        $immeuble = $em->getRepository('App:Immeuble')->findAll();

        $calques = $em->getRepository('App:Calque')->findAll();
        $calquesTab = [];

        foreach($calques as $calque)  {
            $calquesTab[] = $calque->getNom();
        }

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'calques' => $calques,
            'immeubles' => $immeuble,
            'calquesTab' =>$calquesTab
        ]);
    }
}
