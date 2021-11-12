<?php

namespace App\Repository;

use App\Entity\Link;
use App\Entity\LinkVisit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LinkVisit|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkVisit|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkVisit[]    findAll()
 * @method LinkVisit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkVisitRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, LinkVisit::class);
        $this->em = $entityManager;
    }

    // /**
    //  * @return LinkVisit[] Returns an array of LinkVisit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LinkVisit
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function createLinkVisit(Link $link): LinkVisit
    {
        $linkVisit = new LinkVisit();
        $linkVisit->setLink($link)
            ->setCreatedAt(new \DateTimeImmutable());

        $this->em->persist($linkVisit);
        $this->em->flush();

        return $linkVisit;
    }
}
