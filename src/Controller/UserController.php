<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{slug}", name="user_show")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(User $user)
    {
        $admin = false;
        foreach ($this->getUser()->getRoles() as $role) {
            if ($role == 'ROLE_ADMIN'){
                $admin = true;
            }
        }

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'admin' => $admin
        ]);
    }
}
