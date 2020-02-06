<?php

namespace App\Repository;

use App\Entity\Adresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\Client;

/**
 * @method Adresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adresse[]    findAll()
 * @method Adresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdresseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Adresse::class);
    }

    // /**
    //  * @return Adresse[] Returns an array of Adresse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adresse
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    // Exercice 1) Insérer des clients et des adresses
    public function insererClientsAdresses(){
        $em = $this->getEntityManager();
        

        // 1. Créer de clients et une adresse
        $a = new Adresse (['numero'=>'33',
                            'rue'=>'La poire',
                            'codePostal'=> '1190',
                            'ville'=>'Bruxelles',
                            'pays'=>'Belgique']);
        $c1 = new Client (['nom'=>'Loulou',
                            'prenom'=>'Pepe',
                            'email'=>'lala@gmail.com']);
        
        $c2 = new Client (['nom'=>'Dupont',
                            'prenom'=>'Marie',
                            'email'=>'hello@gmail.com']);
        
        $a->addClient ($c1);
        $a->addClient ($c2);
        
        $em->persist ($a);
        $em->flush();
/*        
        // 2. alternatif
        $a = new Adresse (['numero'=>'40',
                            'rue'=>'La pomme',
                            'codePostal'=> '1190',
                            'ville'=>'Bruxelles',
                            'pays'=>'Belgique']);
        $c1 = new Client (['nom'=>'Hermant',
                            'prenom'=>'Lisa',
                            'email'=>'lala@gmail.com']);
        
        $c2 = new Client (['nom'=>'Coucou',
                            'prenom'=>'Hello',
                            'email'=>'hello@gmail.com']);
        
        $c1->setAdresse($a);
        $c2->setAdresse($a);
        $em->persist ($c1);
        $em->persist ($c2);
        
        $em->flush();
 */      
        
    }
    
    // Exercice 2) Rajouter un client à une adresse existante
    public function rajouterClientAdresse(){
        $em = $this->getEntityManager();
        
        $adresseExistante = $this->findOneBy (['rue'=>'La poire']);
        $c = new Client (['nom'=>'Monty',
                            'prenom'=>'Python',
                            'email'=>'hello@gmail.com']);
        
        $adresseExistante->addClient ($c);
        // pas besoin: $em->persist($adresseExistante);
        $em->flush();
    }
}
