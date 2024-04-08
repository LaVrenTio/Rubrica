<?php

namespace App\Repository;

use App\Entity\Contatti;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
/**
 * @extends ServiceEntityRepository<Contatti>
 *
 * @method Contatti|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contatti|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contatti[]    findAll()
 * @method Contatti[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContattiRepository extends ServiceEntityRepository
{
    private $validator;
    public function __construct(ManagerRegistry $registry, ValidatorInterface $validator)
    {
        parent::__construct($registry, Contatti::class);
        $this->validator = $validator;
    }

    

public function save(Contatti $contatto)
{
   // dd('qui siamo');
    // $errors = $this->validator->validate($contatto);
    // if (count($errors) > 0) {
    //     // Handle validation errors...
    //     return;
    // }
    $entityManager = $this->getEntityManager();
    $entityManager->beginTransaction();
    try {
        $entityManager->persist($contatto);
        $entityManager->flush();
        $entityManager->commit();
    } catch (\Exception $e) {
        $entityManager->rollback();
        throw $e;
    }
   
    
}

public function gestioneContatto(Contatti $contatto):?Contatti
{
   $tempCont= $this->findOneBySomeField($contatto->getNome(),$contatto->getCognome());
   if(empty($tempCont))
   {    
        $this->save($contatto);
        return $contatto;
   }else{
    
    return null;
   }
    return $contatto;
}

   public function findOneBySomeField($value,$val): ?Contatti
   {    
    
    return  $this->createQueryBuilder('c')
           ->andWhere('c.nome = :val')
           ->andWhere('c.cognome = :val2')
           ->setParameter('val', $value)
           ->setParameter('val2', $val)
           ->getQuery()
           ->getOneOrNullResult()
       ;
       
       
   }

   //    /**
//     * @return Contatti[] Returns an array of Contatti objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.citta = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
}
