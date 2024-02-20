<?php

namespace App\Enums;

enum StatusEnum: string
{
    case NEW = 'new';
    case ACCEPTED = 'active';
    case REJECTED = 'blocked';
    case DELETED = 'deleted';

    public static function getStatusName(StatusEnum $status): string
    {
        $statusNames = [
            self::NEW->value => 'Новое',
            self::ACCEPTED->value => 'Подтверждено',
            self::REJECTED->value => 'Отклонено',
            self::DELETED->value => 'Удалена'
        ];
        return $statusNames[$status->value];
    }
}
