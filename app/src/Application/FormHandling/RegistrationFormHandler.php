<?php

namespace App\Application\FormHandling;

use App\Application\Service\Security\RegistrationService;
use App\Domain\Entity\User\User;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class RegistrationFormHandler
{
    public function __construct(private RegistrationService $registrationService)
    {
    }

    public function handleRegistrationForm(Request $request, FormInterface $form, User $user): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->registrationService->registerUser($user, $form->get('plainPassword')->getData());
            return true;
        }

        return false;
    }
}
