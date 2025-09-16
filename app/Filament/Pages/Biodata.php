<?php

namespace App\Filament\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload; // <-- IMPORT TAMBAHAN
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Biodata extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.pages.biodata';

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $this->form->fill($user->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel(),
                TextInput::make('address')
                    ->label('Alamat')
                    ->columnSpanFull(),

                // -- FIELD UPLOAD DITAMBAHKAN DI SINI --
                FileUpload::make('image')
                    ->label('Ganti Foto Profil')
                    ->image()
                    ->maxSize(2048) // 2MB
                    ->disk('public') // Simpan di storage/app/public
                    ->directory('profiles'), // Dalam folder 'profiles'

                FileUpload::make('scanijazah')
                    ->label('Ganti Scan Ijazah')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->maxSize(5120) // 5MB
                    ->disk('public')
                    ->directory('scanijazah'),
            ])
            ->columns(2) // Atur form menjadi 2 kolom
            ->statePath('data');
    }

    public function updateBiodata(): void
    {
        $user = Auth::user();
        $originalData = $this->form->getState();

        // Siapkan data untuk diupdate, kecuali file
        $updateData = collect($originalData)->except(['image', 'scanijazah'])->all();

        // Cek jika ada file FOTO PROFIL baru yang di-upload
        if ($originalData['image'] instanceof \Illuminate\Http\UploadedFile) {
            // Hapus file lama jika ada
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            // Simpan file baru dan dapatkan path-nya
            $updateData['image'] = $originalData['image']->store('profiles', 'public');
        } else {
            // Jika tidak ada file baru, pertahankan path file lama
            $updateData['image'] = $originalData['image'];
        }

        // Cek jika ada file SCAN IJAZAH baru yang di-upload
        if ($originalData['scanijazah'] instanceof \Illuminate\Http\UploadedFile) {
            if ($user->scanijazah) {
                Storage::disk('public')->delete($user->scanijazah);
            }
            $updateData['scanijazah'] = $originalData['scanijazah']->store('scanijazah', 'public');
        } else {
            $updateData['scanijazah'] = $originalData['scanijazah'];
        }

        // Update semua data ke database
        $user->update($updateData);

        // Reset form state setelah update agar preview gambar hilang
        $this->form->fill($user->fresh()->toArray());

        Notification::make()
            ->title('Biodata berhasil diperbarui')
            ->success()
            ->send();
    }
}
