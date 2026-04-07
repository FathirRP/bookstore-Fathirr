<x-layouts.app title="Daftar">
    <div class="max-w-md mx-auto px-4 py-16">
        <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-8">
            <h2 class="text-2xl font-bold text-stone-900 text-center mb-6">Buat Akun Baru</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="space-y-4">
                    <x-input label="Nama Lengkap" name="name" required />
                    <x-input label="Email" name="email" type="email" required />
                    <x-input label="Kata Sandi" name="password" type="password" required />
                    <x-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" required />

                    <x-btn type="submit" class="w-full justify-center">Daftar</x-btn>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-stone-600">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-emerald-700 hover:text-emerald-800 font-medium">Masuk di sini</a>
            </p>
        </div>
    </div>
</x-layouts.app>
