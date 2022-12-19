<?php

namespace App\Controller\NewYearClubs\GetEvents;

use App\Controller\NewYearClubs\NewYearClubsResponse;
use App\Entity\NewYearClubs;
use App\Repository\NewYearClubsRepository;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GetEventsController extends AbstractController
{
    private NewYearClubsRepository $newYearClubsRepository;

    public function __construct(NewYearClubsRepository $newYearClubsRepository)
    {
        $this->newYearClubsRepository = $newYearClubsRepository;
    }

    /**
     * @Route("/api/new-year-clubs/{email}", methods={"GET"})
     */
    public function __invoke(string $email): View
    {
        $newYearClubs = $this->newYearClubsRepository->findOneBy(['email' => $email]);

        if ($newYearClubs === null) {
            $newNewYearClubs = new NewYearClubs();
            $newNewYearClubs->setEmail($email);
            $newNewYearClubs->setEvents('');
            $newNewYearClubs->setCreatedAt(new \DateTimeImmutable());
            $newNewYearClubs->setUpdatedAt(new \DateTimeImmutable());

            $this->newYearClubsRepository->save($newNewYearClubs);
            return View::create(NewYearClubsResponse::createNewYearClubsResponse($newNewYearClubs));
        }

        return View::create(NewYearClubsResponse::createNewYearClubsResponse($newYearClubs));
    }
}
