<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Note>
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);
    }

    //    /**
    //     * @return Note[] Returns an array of Note objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Note
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * Calcule les moyennes par matière pour un élève
     * @return array Array avec 'matiere' => Matiere, 'moyenne' => float
     */
    public function findMoyennesParMatiere(int $eleveId): array
    {
        return $this->createQueryBuilder('n')
            ->select('m.id as matiere_id, m.nom as matiere_nom, m.coef, AVG(n.note) as moyenne')
            ->join('n.matiere', 'm')
            ->where('n.eleve.id = :eleveId')
            ->setParameter('eleveId', $eleveId)
            ->groupBy('m.id', 'm.nom', 'm.coef')
            ->getQuery()
            ->getResult();
    }

    /**
     * Calcule la moyenne générale d'un élève
     */
    public function findMoyenneGenerale(int $eleveId): ?float
    {
        $result = $this->createQueryBuilder('n')
            ->select('AVG(n.note) as moyenne')
            ->where('n.eleve.id = :eleveId')
            ->setParameter('eleveId', $eleveId)
            ->getQuery()
            ->getSingleScalarResult();

        return $result ? (float) $result : null;
    }
}
