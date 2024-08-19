<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\SalesRep;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InvoiceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InvoiceResource\RelationManagers;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('invoice_date'),
                Forms\Components\Select::make('customer_id')
                    ->options(Customer::all()->pluck('name','id'))
                    ->label('Customer')
                    ->required(), 
                Forms\Components\Select::make('sales_rep_id')
                    ->options(SalesRep::all()->pluck('name','id'))
                    ->label('Sales Ref')
                    ->required(),
                Forms\Components\TextInput::make('invoice_number')
                    ->required()
                    ->unique(ignoreRecord:true)
                    ->maxLength(20),
                Forms\Components\TextInput::make('amount')
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->numeric(),
                // Forms\Components\TextInput::make('chq')
                //     ->numeric(),
                // Forms\Components\TextInput::make('chq_numbers')
                //     ->maxLength(100),
                // Forms\Components\DatePicker::make('chq_date'),
                // Forms\Components\TextInput::make('chq_status')
                // ->required()
                // ->numeric(),
                Forms\Components\TextInput::make('outstanding')
                    ->numeric(),
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('selesRep.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('invoice_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cash')
                ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('chq')
                //     ->numeric()
                //     ->toggleable(isToggledHiddenByDefault: true)
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('chq_numbers')
                // ->toggleable(isToggledHiddenByDefault: true)
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('chq_date')
                // ->toggleable(isToggledHiddenByDefault: true)
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('chq_status')
                // ->toggleable(isToggledHiddenByDefault: true)
                //     ->numeric()
                //     ->sortable(),
                    Tables\Columns\TextColumn::make('outstanding')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            // 'create' => Pages\CreateInvoice::route('/create'),
            // 'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
