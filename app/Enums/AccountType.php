<?php

namespace App\Enums;

enum AccountType: string
{
    case Bank = 'bank';
    case Securities = 'securities';
    case CreditCard = 'credit_card';
    case Point = 'point';
    case Cash = 'cash';

    public function label(): string
    {
        return match($this) {
            self::Bank => '銀行',
            self::Securities => '証券',
            self::CreditCard => 'クレカ',
            self::Point => 'ポイント',
            self::Cash => '現金',
        };
    }
}
