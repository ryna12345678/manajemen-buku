<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-slate-100 px-4 py-10">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

            <div class="text-center mb-8">
                <div class="mx-auto w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-4">
                    <span class="text-3xl">📚</span>
                </div>

                <h1 class="text-2xl font-bold text-slate-800">
                    Buat Akun Baru
                </h1>

                <p class="text-sm text-slate-500 mt-2">
                    Daftarkan akun untuk mengakses Manajemen Buku
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" value="Nama Lengkap" class="text-slate-700 font-semibold" />
                    <x-text-input
                        id="name"
                        class="block mt-2 w-full rounded-lg border-slate-300"
                        type="text"
                        name="name"
                        :value="old('name')"
                        placeholder="Masukkan nama lengkap"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <x-input-label for="email" value="Email" class="text-slate-700 font-semibold" />
                    <x-text-input
                        id="email"
                        class="block mt-2 w-full rounded-lg border-slate-300"
                        type="email"
                        name="email"
                        :value="old('email')"
                        placeholder="Masukkan email"
                        required
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <x-input-label for="password" value="Password" class="text-slate-700 font-semibold" />
                    <x-text-input
                        id="password"
                        class="block mt-2 w-full rounded-lg border-slate-300"
                        type="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-slate-700 font-semibold" />
                    <x-text-input
                        id="password_confirmation"
                        class="block mt-2 w-full rounded-lg border-slate-300"
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button
                    type="submit"
                    class="w-full mt-7 py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200"
                >
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-slate-500">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                    Masuk di sini
                </a>
            </div>

            <p class="text-center text-xs text-slate-400 mt-8">
                Sistem Informasi Manajemen Buku
            </p>
        </div>
    </div>
</x-guest-layout>
