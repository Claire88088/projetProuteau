<?php

namespace App\Controller;

use App\Entity\Calque;
use App\Form\ChoiceCalqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CalqueType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Annotations\Annotation;

class MapController extends AbstractController
{
    #[Route('/map', name: 'map')]
    public function indexAction(EntityManagerInterface $em, Request $request): Response
    {
        $immeuble = $em->getRepository('App:Immeuble')->findAll();

        $calques = $em->getRepository('App:Calque')->findAll();
        $calquesTab = [];
        $options = [];

        foreach($calques as $calque)  {
            $calquesTab[] = $calque->getNom();
            $options[$calque->getNom()] = $calque->getNom();
        }



        // Création du formulaire de choix de calque directement dans le controller
        $choiceCalqueForm = $this->createFormBuilder()
            ->add('calque', ChoiceType::class, ['choices' => $options])
            ->add('Selectionner', SubmitType::class, [
                'label' => 'Sélectionner ce calque'])
            ->getForm();



        /* Création du formulaire de choix de calque à partir d'une classe ChoiceCalqueType
        $choiceCalqueForm = $this->createForm(ChoiceCalqueType::class, ['test'=>'valeurTest']);
        $choiceCalqueForm->add('Ajouter', SubmitType::class, ['label' => 'Ajouter un nouveau calque']);
        */
        $choiceCalqueForm->handleRequest($request);

        if ($choiceCalqueForm->isSubmitted() && $choiceCalqueForm->isValid()) {
            var_dump($request->request->get('form')['calque']);

            return $this->redirectToRoute('map');
        }

        return $this->render('map/index.html.twig', [
            'calques' => $calques,
            'immeubles' => $immeuble,
            'calquesTab' =>$calquesTab,
            'choiceCalqueForm' => $choiceCalqueForm->createView()
        ]);

    }
/*
    public function selectCalqueAction(): Response
    {
        return $this->render('map/add-element-er.html.twig', [

        ]);
    }
 */
    /*
    #[Route('/map/select-calque', name: 'select_calque')]
    public function selectCalqueAction(EntityManagerInterface $em, Request $request): Response
    {
        var_dump($request->request->all());
        return $this->render('map/add-element-er.html.twig', [

        ]);
    }
*/

    #[Route('/test', name: 'test')]
    public function selectCalqueAction(EntityManagerInterface $em, Request $request): Response
    {
        var_dump($request->request->get('testrecup'));

        return $this->render('map/add-element-er.html.twig', [

        ]);
    }

    #[Route('/map/add-calque', name: 'add_calque')]
    public function addCalqueAction(EntityManagerInterface $em, Request $request): Response
    {
        $calque = new Calque();
        $form = $this->createForm(CalqueType::class, $calque);
        $form->add('Ajouter', SubmitType::class, ['label' => 'Ajouter un nouveau calque']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($request->request->all());

            $em->persist($calque);
            $em->flush();
            return $this->redirectToRoute('map');
        }

        return $this->render('map/add-calque.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
