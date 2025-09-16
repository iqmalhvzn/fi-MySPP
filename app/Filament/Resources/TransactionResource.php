<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Department;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Department Name')
                    ->required()
                    ->readOnly()
                    ->default(fn() => 'TRX-' . mt_rand(100000, 999999))
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('users', 'name')
                    ->required(),
                Forms\Components\TextInput::make('payment_status')
                    ->readOnly()
                    ->default('pending')
                    ->label('Payment Status'),

                Forms\Components\Fieldset::make('department_id')
                    ->label('Department')
                    ->schema([
                        Forms\Components\Select::make('department_id')
                            ->label('Department')
                            ->options(Department::query()->get()->mapWithKeys(function ($department) {
                                return [$department->id => $department->name . ' - ' . $department->semester];
                            })->toArray())
                            ->reactive()
                            ->afterStateUpdated(fn(callable $set, $state) => $set('cost', Department::find($state)?->cost))
                            ->required(),
                        Forms\Components\TextInput::make('cost')
                            ->label('Cost')
                            ->prefix('Rp')
                            ->numeric()
                            ->disabled(),

                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Transaction Code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('users.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departments.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departments.semester')
                    ->label('Semester')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departments.cost')
                    ->label('Cost')
                    ->money('IDR', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->badge(fn($record) => match($record->payment_status) {
                        'pending' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                        default => 'secondary',
                    })
                    ->color(fn($record) => match($record->payment_status) {
                        'pending' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                        default => 'secondary',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTransactions::route('/'),
        ];
    }
}
