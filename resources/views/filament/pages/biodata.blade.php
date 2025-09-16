<x-filament-panels::page>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KOLOM 1: KARTU BIODATA --}}
        <div class="lg:col-span-1 space-y-4">
            <x-filament::section>
                <x-slot name="heading">
                    Informasi Biodata
                </x-slot>

                <div class="flex items-center space-x-4">
                    @if (auth()->user()->image)
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Foto Profil" class="h-20 w-20 rounded-full object-cover">
                    @else
                        <div class="h-20 w-20 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <x-heroicon-o-user class="h-10 w-10 text-gray-500" />
                        </div>
                    @endif

                    <div>
                        <h2 class="text-xl font-bold">{{ auth()->user()->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor Telepon</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ auth()->user()->phone ?: '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ auth()->user()->address ?: '-' }}</dd>
                        </div>

                        {{-- BAGIAN BARU UNTUK MENAMPILKAN SCAN IJAZAH --}}
                        @if (auth()->user()->scanijazah)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Scan Ijazah</dt>
                                <dd class="mt-1">
                                    <a href="{{ asset('storage/' . auth()->user()->scanijazah) }}" target="_blank"
                                        class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-500 dark:hover:text-primary-400 flex items-center space-x-1">
                                        <x-heroicon-o-document-arrow-down class="h-5 w-5" />
                                        <span>Lihat / Unduh File</span>
                                    </a>
                                </dd>
                            </div>
                        @endif
                        {{-- AKHIR BAGIAN BARU --}}

                         <div>
                             <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bergabung pada</dt>
                             <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ auth()->user()->created_at->format('d F Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </x-filament::section>
        </div>


        {{-- KOLOM 2: FORM UPDATE PROFIL --}}
        <div class="lg:col-span-2">
            <form wire:submit.prevent="updateBiodata">
                <x-filament::section>
                    <x-slot name="heading">
                        Ubah Biodata
                    </x-slot>

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
