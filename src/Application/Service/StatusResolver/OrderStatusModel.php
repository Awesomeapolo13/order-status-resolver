<?php

declare(strict_types=1);

namespace App\Application\Service\StatusResolver;

use App\Application\Service\StatusResolver\DTO\OrderStatusDto;
use App\Application\Service\StatusResolver\Trait\FindActualStatusTrait;
use App\Domain\Entity\OrderStatus;

class OrderStatusModel
{
    use FindActualStatusTrait;

    public function __construct(
        private int $statusId,
        private string $code,
        private string $title,
        private ?string $subTitle = null,
        private string $description = '',
        private ?int $iconType = null,
        private bool $isActive = false,
    ) {
    }

    public function updateDescriptionAccordingState(OrderStatusDto $statusDto): void
    {
        $actualStatus = $this->findActualStatus($this->statusId, $statusDto->statuses);
        $this->setDefault($actualStatus);
        // ToDo: Реализовать обновление описания модели
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIconType(): ?int
    {
        return $this->iconType;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    private function setDefault(OrderStatus $status): void
    {
        $content = $status->getContent();

        $this->title = $content->getTitle();
        $this->subTitle = $content->getDefaultSubTitle();
        $this->description = $content->getDefaultDescription();
        $this->iconType = $content->getDefaultIcoType();
        $this->code = $status->getCode()->getCode();
    }
}
