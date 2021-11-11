<?php

namespace App\Repository;

use App\Entity\Link;
use App\Service\SlugGeneratorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Link|null find($id, $lockMode = null, $lockVersion = null)
 * @method Link|null findOneBy(array $criteria, array $orderBy = null)
 * @method Link[]    findAll()
 * @method Link[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $em;
    private SlugGeneratorInterface $slugGenerator;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager, SlugGeneratorInterface $slugGenerator)
    {
        parent::__construct($registry, Link::class);
        $this->em = $entityManager;
        $this->slugGenerator = $slugGenerator;
    }

    // /**
    //  * @return Link[] Returns an array of Link objects
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
    public function findOneBySomeField($value): ?Link
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @throws NonUniqueResultException
     */
    public function findOneBySlug($value): ?Link
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.slug = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function createLink(string $url): ?Link
    {
        $link = new Link();
        $link->setUrl($url)
            ->setSlug($this->createUniqueSlug());

        $this->em->persist($link);
        $this->em->flush();

        return $link;
    }

    /**
     * @throws NonUniqueResultException
     */
    private function createUniqueSlug(): string
    {
        do {
            $slug = $this->slugGenerator->generate();
            $linkWithSlug = $this->findOneBySlug($slug);
        } while ($linkWithSlug);

        return $slug;
    }
}
