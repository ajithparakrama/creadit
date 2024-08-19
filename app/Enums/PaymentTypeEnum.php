<?php 
namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentTypeEnum: string implements HasColor, HasLabel, HasIcon
{
    case CLEAR = '9';
    case PENDING = '1';
    case RETURN ='2';

    public function getColor(): ?string
    {
        return match($this){
            self::CLEAR =>'success',
            self::PENDING=>'warning',
            self::RETURN=>'danger'
        };
    }

    public function getLabel(): ?string
    {
        return match($this){
            self::CLEAR=>'Clear',
            self::PENDING=>'Pending',
            self::RETURN=>'Return'
        };
    }

    public function getIcon(): string
    {
        return match($this){
            self::CLEAR=>'fa fa-check',
            self::PENDING=>'fa fa-time',
            self::RETURN=>'fa fa-times'
        };
    }
}