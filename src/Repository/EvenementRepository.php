<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evenement::class);
    }


    /*
     * Affichage de tous les évenements trié par creation (id) en ordre descandant
     */
    public function findEvent()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'desc')
            ->getQuery()
            ->getResult()
            ;
    }


    /*
     * fonction pour afficher les 4 derniers événements
     * Utilisé dans la page d'accueil
     */
    public function findLatest()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'desc')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
            ;
    }



    // /**
    //  * @return Evenement[] Returns an array of Evenement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evenement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
