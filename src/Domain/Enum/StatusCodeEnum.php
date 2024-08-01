<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum StatusCodeEnum: string
{
    case Placed = 'placed';
    case Preparing = 'preparing';
    case TransferToShop = 'transfer_to_shop';
    case Accepted = 'accepted';
    case Ready = 'ready';
    case NeedPay = 'need_pay';
    case TransferCourier = 'transfer_courier';
    case Finished = 'finished';
    case Delivered = 'delivered';
}
