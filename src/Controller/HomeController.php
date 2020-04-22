<?php

namespace App\Controller;

use App\Repository\AdRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     * @param AdRepository $adRepositoryepo
     * @param UserRepository $userRepository
     * @return Response
     */
    public function home(AdRepository $adRepositoryepo, UserRepository $userRepository) {

        $ads = $adRepositoryepo->findAll();
        $users = $userRepository->findAll();

        return $this->render('home.html.twig', [
            'title' => 'Hello',
            'ads' => $ads,
            'users' => $users
        ]);
    }
}

