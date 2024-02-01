<?php

namespace App\UI\Controller\Security;

use App\Application\FormHandling\RegistrationFormHandler;
use App\Application\Service\Security\AppCustomAuthenticator;
use App\Application\Service\Security\RegistrationService;
use App\Domain\Repository\User\UserRepositoryInterface;
use App\UI\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request                    $request,
        RegistrationFormHandler    $registrationFormHandler,
        UserAuthenticatorInterface $userAuthenticator,
        AppCustomAuthenticator     $authenticator,
        UserRepositoryInterface    $userRepository
    ): Response
    {
        $user = $userRepository->createUser();
        $form = $this->createForm(RegistrationFormType::class, $user);

        if ($registrationFormHandler->handleRegistrationForm($request, $form, $user)) {

            return $userAuthenticator->authenticateUser($user, $authenticator, $request);

        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
