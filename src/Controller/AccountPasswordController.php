<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Modifier le mot de passe d'un utilisateur
     * @Route("/mon-compte/motdepasse", name="account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $notification_success = null;
        $notification_error = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('oldPassword')->getData();
            if ($encoder->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('newPassword')->getData();
                $password = $encoder->encodePassword($user, $new_pwd);

                $user->setPassword($password);
                $this->entityManager->flush();
                $notification_success = 'Votre mot de passe a bien été mis à jour';
            } else {
                $notification_error = 'Mot de passe actuel invalide, veuillez réessayer';
            }
        }

        return $this->render('account/password.html.twig', [
            'passwordForm' => $form->createView(),
            'notification_success' => $notification_success,
            'notification_error' => $notification_error
        ]);
    }
}
