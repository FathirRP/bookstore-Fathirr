<x-layouts.app title="Masuk">
    <div class="max-w-md mx-auto px-4 py-16">
        <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-8">
            <h2 class="text-2xl font-bold text-stone-900 text-center mb-6">Masuk ke Akun Anda</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-4">
                    <x-input label="Email" name="email" type="email" required />

                    {{-- Password pake toggle buat liat/sembunyiin --}}
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                        <div class="relative">
                            <input
                                :type="show ? 'text' : 'password'"
                                name="password"
                                id="password"
                                required
                                class="w-full px-3 py-2 pr-10 border border-stone-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                            >
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors">
                                {{-- Ikon mata (keliatan) --}}
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{-- Ikon mata coret (disembunyiin) --}}
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="rounded border-stone-300 text-emerald-600 focus:ring-emerald-500">
                        <label for="remember" class="ml-2 text-sm text-stone-600">Ingat saya</label>
                    </div>

                    <x-btn type="submit" class="w-full justify-center">Masuk</x-btn>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-stone-600">
                Belum punya akun? <a href="{{ route('register') }}" class="text-emerald-700 hover:text-emerald-800 font-medium">Daftar sekarang</a>
            </p>
        </div>
    </div>
</x-layouts.app>
