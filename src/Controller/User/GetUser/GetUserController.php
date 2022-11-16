<?php

namespace App\Controller\User\GetUser;

use App\Controller\User\UserResponse;
use App\Repository\UserRepository;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetUserController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/user/{id}", methods={"GET"})
     */
    public function __invoke(int $id): View
    {
        $user = $this->userRepository->find($id);
        if ($user === null) {
            return View::create(null,Response::HTTP_NOT_FOUND);
        }

        return View::create(UserResponse::createUserResponse($user));
    }
}
