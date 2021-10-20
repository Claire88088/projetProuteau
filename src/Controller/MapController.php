<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    #[Route('/map', name: 'map')]
    public function indexAction(EntityManagerInterface $em): Response
    {
        $immeuble = $em->getRepository('App:Immeuble')->findAll();

        $calques = $em->getRepository('App:Calque')->findAll();
        $calquesTab = [];

        foreach($calques as $calque)  {
            $calquesTab[] = $calque->getNom();
        }

        return $this->render('base.html.twig', [
            'calques' => $calques,
            'immeubles' => $immeuble,
            'calquesTab' =>$calquesTab
        ]);

    }


}
