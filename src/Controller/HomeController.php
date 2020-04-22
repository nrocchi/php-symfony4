<?php

namespace App\Controller;

use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     * @param AdRepository $repo
     * @return Response
     */
    public function home(AdRepository $repo) {

        $ads = $repo->findAll();

        return $this->render('home.html.twig', [
            'title' => 'Hello',
            'ads' => $ads
        ]);
    }
}

