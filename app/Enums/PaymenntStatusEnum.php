<?php 
namespace App\Enums; 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel; 

enum PaymenntStatusEnum: string implements HasColor, HasLabel, HasIcon
{ 
    case CASH = '9';
    case CHEQ = '1';
    case BANK_TRANSFER ='2';

    public function getColor(): ?string
    {
        return match($this){
            self::CASH =>'success',
            self::CHEQ=>'warning',
            self::BANK_TRANSFER=>'danger'
        };
    }

    public function getLabel(): ?string
    {
        return match($this){
            self::CASH=>'Cash',
            self::CHEQ=>'Cheq',
            self::BANK_TRANSFER=>'Bank Transfer'
        };
    }

    public function getIcon(): string
    {
        return match($this){
            self::CASH=>'fa fa-check',
            self::CHEQ=>'fa fa-time',
            self::BANK_TRANSFER=>'fa fa-times'
        };
    }
}