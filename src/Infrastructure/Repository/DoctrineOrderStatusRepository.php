<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\OrderStatus;
use App\Domain\Repository\OrderStatusRepositoryInterface;
use App\Domain\Repository\Query\GetStatusesByTypeQuery;
use App\Domain\ValueObject\OrderType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineOrderStatusRepository extends ServiceEntityRepository implements OrderStatusRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderStatus::class);
    }

    /**
     * todo Пересоздать таблицу, т.к. statusId в составе индекса не нужен
     */
    public function findStatusesByType(GetStatusesByTypeQuery $query): array
    {
        $result = $this
            ->createQueryBuilder('os')
            ->where('os.orderType = :orderType')
            ->setParameter('orderType', new OrderType($query->isDelivery, $query->isExpress))
            ->getQuery()
            ->getResult()
        ;

        return [];
    }
}
