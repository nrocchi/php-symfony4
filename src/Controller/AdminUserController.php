<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users_index")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }

    /**
     * Permet de supprimer un user
     *
     * @Route("/admin/users/{id}/delete", name="admin_users_delete")
     *
     * @param User $user
     * @param ObjectManager $manager
     * @return RedirectResponse
     */
    public function delete(User $user, ObjectManager $manager)
    {
        $admin = false;
        foreach ($user->getRoles() as $role) {
            if ($role == 'ROLE_ADMIN'){
                $admin = true;
            }
        }
        if ($admin){
            $this->addFlash(
                'danger',
                "Impossible de supprimer cet utilisateur car il est administrateur."
            );
        }
        else if (count($user->getAds()) > 0){
            $this->addFlash(
                'danger',
                "Impossible de supprimer cet utilisateur car il a déjà publié une annonce."
            );
        }
        else if (count($user->getBookings()) > 0){
            $this->addFlash(
                'danger',
                "Impossible de supprimer cet utilisateur car il a déjà effectué une réservation."
            );
        }
        else {
            $manager->remove($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'utilisateur <strong>{$user->getFullName()}</strong> a bien été supprimé !"
            );
        }

        return $this->redirectToRoute('admin_users_index');
    }
}
