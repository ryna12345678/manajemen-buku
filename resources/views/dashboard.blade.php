<x-app-layout>

    <x-slot name="header">

        <div class="page-heading">

            <div>
                <h1>Dashboard</h1>
                <p>Selamat datang di sistem informasi Manajemen Buku.</p>
            </div>

            <div class="date-chip">
                📅 {{ now()->translatedFormat('d F Y') }}
            </div>

        </div>

    </x-slot>

    <!-- WELCOME -->
    <div class="welcome-card">

        <div class="welcome-decoration">▤</div>

        <h2>
            Halo, {{ auth()->user()->name }}! 👋
        </h2>

        <p>
            Selamat datang kembali. Kelola koleksi buku dengan mudah
            melalui sistem Manajemen Buku.
        </p>

    </div>

    <!-- STATISTIK -->
    <div class="section-title">
        Ringkasan Data
    </div>

    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-top">
                <div class="stat-label">Total Buku</div>
                <div class="stat-icon blue-icon">📚</div>
            </div>

            <div class="stat-number">
                {{ number_format($totalBuku, 0, ',', '.') }}
            </div>

            <div class="stat-label">
                Jumlah koleksi buku terdaftar
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-top">
                <div class="stat-label">Total Stok</div>
                <div class="stat-icon green-icon">📦</div>
            </div>

            <div class="stat-number">
                {{ number_format($totalStok, 0, ',', '.') }}
            </div>

            <div class="stat-label">
                Jumlah seluruh stok buku
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-top">
                <div class="stat-label">Total Pengguna</div>
                <div class="stat-icon orange-icon">👥</div>
            </div>

            <div class="stat-number">
                {{ number_format($totalPengguna, 0, ',', '.') }}
            </div>

            <div class="stat-label">
                Akun pengguna terdaftar
            </div>

        </div>

    </div>

    <!-- MENU CEPAT -->
    <div class="section-title">
        Menu Aplikasi
    </div>

    <div class="quick-grid">

        @can('lihat buku')
        <a href="{{ route('books.index') }}" class="quick-card">

            <div class="quick-icon">📚</div>

            <h3>Daftar Buku</h3>

            <p>
                Lihat dan kelola informasi koleksi buku.
            </p>

        </a>
        @endcan

        @can('tambah buku')
        <a href="{{ route('books.create') }}" class="quick-card">

            <div class="quick-icon">➕</div>

            <h3>Tambah Buku</h3>

            <p>
                Tambahkan data buku baru ke dalam sistem.
            </p>

        </a>
        @endcan

        @can('kelola role')
        <a href="{{ route('users.index') }}" class="quick-card">

            <div class="quick-icon">👥</div>

            <h3>Kelola Pengguna</h3>

            <p>
                Lihat akun dan atur hak akses pengguna.
            </p>

        </a>
        @endcan

    </div>

</x-app-layout>
