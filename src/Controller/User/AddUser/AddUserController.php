<?php

namespace App\Controller\User\AddUser;

use App\Entity\User;
use App\Repository\UserRepository;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddUserController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/user/add", methods={"POST"})
     */
    public function __invoke(Request $request): View
    {
        $data = json_decode($request->getContent(),true);

        //TODO validation + RequestClass + ifExist
        $newUser = new User();
        $newUser->setLogin($data['login']);
        $newUser->setPassword($data['password']);
        $newUser->setRole($data['role']);
        $newUser->setName($data['name']);
        $newUser->setUpdatedAt(new \DateTimeImmutable());

        $this->userRepository->save($newUser);

        return View::create(null, Response::HTTP_NO_CONTENT);
    }
}
