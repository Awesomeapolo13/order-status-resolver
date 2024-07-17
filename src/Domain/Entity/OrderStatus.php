<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\OrderType;
use App\Domain\ValueObject\StatusCode;
use App\Domain\ValueObject\StatusContent;

class OrderStatus
{
    public function __construct(
        private int    $statusId,
        private OrderType $orderType,
        private StatusCode $code,
        private StatusContent $content,
    ) {
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setStatusId(int $statusId): self
    {
        $this->statusId = $statusId;

        return $this;
    }

    public function getOrderType(): OrderType
    {
        return $this->orderType;
    }

    public function setOrderType(OrderType $OrderType): self
    {
        $this->orderType = $OrderType;

        return $this;
    }

    public function getCode(): StatusCode
    {
        return $this->code;
    }

    public function setCode(StatusCode $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getContent(): StatusContent
    {
        return $this->content;
    }

    public function setContent(StatusContent $content): self
    {
        $this->content = $content;

        return $this;
    }
}
