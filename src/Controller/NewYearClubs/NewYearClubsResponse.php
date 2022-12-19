<?php

declare(strict_types=1);

namespace App\Controller\NewYearClubs;

use App\Entity\NewYearClubs;

class NewYearClubsResponse
{
    static public function createNewYearClubsResponse(NewYearClubs $newYearClubs): array
    {
        return [
            'id' => $newYearClubs->getId(),
            'email' => $newYearClubs->getEmail(),
            'events' => $newYearClubs->getEvents(),
            'createdAt' => $newYearClubs->getCreatedAt(),
            'updatedAt' => $newYearClubs->getUpdatedAt(),
        ];
    }
}
