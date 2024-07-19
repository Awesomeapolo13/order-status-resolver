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
     * Получение списка статусов по типу заказа.
     */
    public function findStatusesByType(GetStatusesByTypeQuery $query): array
    {
        return $this
            ->createQueryBuilder('os')
            ->where('os.orderType.isDelivery = :isDelivery')
            ->setParameter('isDelivery', $query->isDelivery)
            ->andWhere('os.orderType.isExpress = :isExpress')
            ->setParameter('isExpress', $query->isExpress)
            ->getQuery()
            ->getResult();
    }
}
