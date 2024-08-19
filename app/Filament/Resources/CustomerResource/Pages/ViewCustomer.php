<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\CustomerResource\RelationManagers\InvoiceRelationManager;

class ViewCustomer extends ViewRecord
{
    protected static string $resource = CustomerResource::class;

    public function getRelationManagers(): array
    {
        return [
            InvoiceRelationManager::class,
        ];
    }
}
