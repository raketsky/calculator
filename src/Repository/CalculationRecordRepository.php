<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\CalculationRecord;

/**
 * @method CalculationRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalculationRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalculationRecord[]    findAll()
 * @method CalculationRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void                   add(CalculationRecord $calculationRecord)
 * @method void                   update(CalculationRecord $calculationRecord)
 */
final class CalculationRecordRepository extends AbstractRepository
{
    public function getEntityClass(): string
    {
        return CalculationRecord::class;
    }

    /**
     * @param int $limit
     * @return CalculationRecord[]
     */
    public function findLast(int $limit): array
    {
        $qb = $this->createQueryBuilder('r');
        $qb->setMaxResults($limit);
        $qb->addOrderBy('r.createdAt', 'DESC');

        return $qb->getQuery()->getResult();
    }
}
