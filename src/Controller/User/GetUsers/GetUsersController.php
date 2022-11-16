<?php

namespace App\Controller\User\GetUsers;

use App\Controller\User\UserResponse;
use App\Repository\UserRepository;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetUsersController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/users", methods={"GET"})
     */
    public function __invoke(): View
    {
        $users = $this->userRepository->findAll();
        if (count($users) === 0) {
            return View::create(null,Response::HTTP_NOT_FOUND);
        }

        return View::create(UserResponse::createUsersResponse($users));
    }
}
