<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver;

use App\Application\Service\StatusResolver\DTO\OrderStatusDto;
use App\Domain\Entity\OrderStatus;

class AddStatusListResolver implements OrderStatusResolverInterface
{
    public function __construct(
        private readonly OrderStatusResolverInterface $activeStatusResolver,
        private readonly OrderStatusResolverInterface $statusListResolver,
    ) {
    }

    public function resolveStatus(OrderStatusDto $orderStatusDto): OrderStatusModel
    {
        // ToDo: Придумать как сделать определение активности статуса в списке.
        //  По сути надо отталкиваться от базового статуста
        $statusList = array_map(
            function (OrderStatus $orderStatus) use ($orderStatusDto): OrderStatusModel {
                $dto = $this->createDtoForList($orderStatus->getStatusId(), $orderStatusDto);

                return $this->statusListResolver->resolveStatus($dto);
            },
            $orderStatusDto->statuses
        );
        $activeStatus = $this->activeStatusResolver->resolveStatus($orderStatusDto);
        $activeStatus->setStatusList($statusList);

        return $activeStatus;
    }

    private function createDtoForList(int $statusId, OrderStatusDto $primaryDto): OrderStatusDto
    {
        return new OrderStatusDto(
            $statusId,
            $primaryDto->orderType,
            $primaryDto->orderState,
            $primaryDto->orderDate,
            $primaryDto->statusCheckedOutAt,
            $primaryDto->workingTime,
            $primaryDto->statuses,
            $primaryDto->delivery,
            $primaryDto->currentDateTime,
        );
    }
}
