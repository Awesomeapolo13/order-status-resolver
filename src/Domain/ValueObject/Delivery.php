<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use DateTime;

readonly class Delivery
{
    public function __construct(
        private DateTime $deliveryDate,
        private DeliverySlot $deliverySlot,
        // todo Вообще не относится к доставке. Нужно убрать отсюда совсем.
        private ?PaymentDateTime $paymentDateTime,
        private string $courierSearchingTime,
    ) {
    }

    public function getDeliveryDate(): DateTime
    {
        return $this->deliveryDate;
    }

    public function getDeliverySlot(): DeliverySlot
    {
        return $this->deliverySlot;
    }

    public function getPaymentDateTime(): PaymentDateTime
    {
        return $this->paymentDateTime;
    }

    public function getCourierSearchingTime(): string
    {
        return $this->courierSearchingTime;
    }
}
