<x-filament-panels::page>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KOLOM 1: KARTU BIODATA (REAKTIF) --}}
        <x-filament::section class="lg:col-span-1">
            <x-slot name="heading">
                Informasi Biodata
            </x-slot>

            <div class="flex items-center space-x-4">
                @if ($this->user->image)
                    <img src="{{ asset('storage/' . $this->user->image) }}" alt="Foto Profil" class="h-20 w-20 rounded-full object-cover">
                @else
                    <div class="h-20 w-20 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <x-heroicon-o-user class="h-10 w-10 text-gray-500" />
                    </div>
                @endif

                <div>
                    {{-- Diubah agar membaca data dari form state untuk reaktivitas --}}
                    <h2 class="text-xl font-bold">{{ $data['name'] }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $data['email'] }}</p>
                </div>
            </div>

            <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor Telepon</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $data['phone'] ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $data['address'] ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bergabung pada</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $this->user->created_at->format('d F Y') }}</dd>
                    </div>
                </dl>
            </div>
        </x-filament::section>

        {{-- KOLOM 2: FORM UNTUK UPDATE BIODATA --}}
        <div class="lg:col-span-2">
            <form wire:submit="updateBiodata">
                <x-filament::section>
                    <x-slot name="heading">
                        Ubah Biodata
                    </x-slot>

                    {{-- Baris ini akan merender semua field form yang didefinisikan di PHP --}}
                    {{ $this->form }}

                    <x-slot name="footer">
                        <div class="text-right">
                            <x-filament::button type="submit">
                                Simpan Perubahan
                            </x-filament::button>
                        </div>
                    </x-slot>
                </x-filament::section>
            </form>
        </div>
    </div>
</x-filament-panels::page>
