<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Biodata extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static string $view = 'filament.pages.biodata';



    protected static ?string $title = 'Profil Saya';

    public ?array $data = [];
    public User $user;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->form->fill($this->user->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->live(onBlur: true),

                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->live(onBlur: true),

                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->live(onBlur: true),

                FileUpload::make('image')
                    ->label('Foto Profil')
                    ->image()
                    ->disk('public')
                    ->directory('profiles'),

                // <-- FIELD SCAN IJAZAH DITAMBAHKAN DI SINI
                FileUpload::make('scanijazah')
                    ->label('Scan Ijazah')
                    ->acceptedFileTypes(['image/*', 'application/pdf'])
                    ->disk('public')
                    ->directory('scanijazah'),

                Textarea::make('address')
                    ->label('Alamat')
                    ->rows(3)
                    ->columnSpanFull()
                    ->live(onBlur: true),
            ])
            ->columns(2)
            ->statePath('data')
            ->model($this->user);
    }

    public function updateBiodata(): void
    {
        $this->user->update(
            $this->form->getState()
        );

        Notification::make()
            ->title('Berhasil!')
            ->body('Biodata Anda telah berhasil diperbarui.')
            ->success()
            ->send();

        // Refresh data di halaman setelah update
        $this->form->fill($this->user->fresh()->toArray());
    }
}
