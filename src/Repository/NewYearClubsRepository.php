<?php

namespace App\Repository;

use App\Entity\NewYearClubs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NewYearClubs>
 *
 * @method NewYearClubs|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewYearClubs|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewYearClubs[]    findAll()
 * @method NewYearClubs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewYearClubsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewYearClubs::class);
    }

    public function save(NewYearClubs $entity, bool $flush = true): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NewYearClubs $entity, bool $flush = true): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
