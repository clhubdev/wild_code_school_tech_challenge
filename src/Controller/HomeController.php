<?php

namespace App\Controller;

use App\Entity\Argonaute;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $argonaute = $doctrine->getRepository(Argonaute::class)->findAll();

        return $this->render('home/index.html.twig', [
            "argonautes" => $argonaute
        ]);
    }

    #[Route('/argonaute', name: 'create_argonaute')]
    public function createArgonaute(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();

        $argonaute = new Argonaute();
        $argonaute->setName($_POST["name"]);

        $entityManager->persist($argonaute);

        $entityManager->flush();

        return $this->redirectToRoute('app_home');

    }
}
