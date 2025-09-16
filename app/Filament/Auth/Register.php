<?php

namespace App\Filament\Auth;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as AuthRegister;
use Illuminate\Support\Facades\Auth;

class Register extends AuthRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        // Gunakan satu Grid untuk membungkus semua field
                        Grid::make(2)->schema([
                            $this->getNameFormComponent()
                                ->columnSpanFull(),
                            $this->getEmailFormComponent()
                                ->columnSpanFull(),

                            // Password dan konfirmasi password akan berdampingan
                            $this->getPasswordFormComponent(),
                            $this->getPasswordConfirmationFormComponent(),

                            // Field tambahan
                            TextInput::make('phone')
                                ->label('Nomor Telepon')
                                ->tel()
                                ->required()
                                ->columnSpanFull(),

                            FileUpload::make('image')
                                ->label('Foto Profil')
                                ->image()
                                ->required()
                                ->maxSize(2048) // 2MB
                                ->columnSpanFull(), // Dibuat lebar penuh agar rapi

                            FileUpload::make('scanijazah')
                                ->label('Scan Ijazah')
                                ->acceptedFileTypes(['image/*', 'application/pdf'])
                                ->required()
                                ->maxSize(5120) // 5MB
                                ->columnSpanFull(), // Dibuat lebar penuh agar rapi
                        ]),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    // Fungsi submit tidak perlu diubah
    protected function submit(): void
    {
        $data = $this->form->getState();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'image' => $data['image'] ? $data['image']->store('profiles', 'public') : null,
            'scanijazah' => $data['scanijazah'] ? $data['scanijazah']->store('scanijazah', 'public') : null,
        ]);

        Auth::login($user);

        redirect()->intended(route('filament.admin.pages.dashboard'));
    }
}
