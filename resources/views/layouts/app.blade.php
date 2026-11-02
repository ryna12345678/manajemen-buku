<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6fb;
            color: #202b43;
        }

        .app-shell { display: flex; min-height: 100vh; }

        .sidebar {
            width: 255px;
            background: #17243d;
            color: white;
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 32px;
            text-decoration: none;
            color: white;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            background: #5277d7;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 21px;
            font-weight: bold;
        }

        .brand-name { font-size: 17px; font-weight: 700; }
        .brand-subtitle { font-size: 11px; color: #aab7cf; margin-top: 3px; }

        .menu-label {
            font-size: 10px;
            letter-spacing: 1.5px;
            color: #8291ad;
            font-weight: 700;
            padding: 10px 12px;
            margin-bottom: 8px;
        }

        .sidebar-menu { display: flex; flex-direction: column; gap: 7px; }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            border-radius: 9px;
            text-decoration: none;
            color: #b9c4d8;
            font-size: 14px;
            transition: .2s;
        }

        .menu-link:hover, .menu-link.active {
            background: #30466f;
            color: white;
        }

        .menu-icon { width: 22px; text-align: center; font-size: 17px; }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 25px;
            border-top: 1px solid #34425c;
        }

        .user-sidebar {
            padding: 12px;
            display: flex;
            gap: 11px;
            align-items: center;
        }

        .avatar {
            width: 39px;
            height: 39px;
            border-radius: 50%;
            background: #dce7ff;
            color: #263d70;
            display: grid;
            place-items: center;
            font-weight: bold;
        }

        .user-name { font-size: 13px; font-weight: 600; }
        .user-role { color: #aab7cf; font-size: 11px; margin-top: 3px; }

        .logout-button {
            width: 100%;
            border: none;
            background: transparent;
            color: #f1a7a7;
            text-align: left;
            padding: 13px 14px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 9px;
        }

        .logout-button:hover { background: #49374a; }

        .main-area { flex: 1; min-width: 0; }

        .topbar {
            background: white;
            min-height: 83px;
            padding: 15px 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e9edf4;
        }

        .topbar-title { font-size: 19px; font-weight: 700; }
        .topbar-subtitle { font-size: 12px; color: #8a94a8; margin-top: 4px; }

        .topbar-profile { display: flex; align-items: center; gap: 12px; }
        .profile-name { font-size: 13px; font-weight: 600; }
        .profile-role { color: #8792a6; font-size: 11px; margin-top: 3px; }

        .content-area {
            padding: 32px 35px;
            max-width: 1500px;
            margin: auto;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 27px;
        }

        .page-heading h1 {
            font-size: 25px;
            font-weight: 750;
            margin: 0;
            color: #202b43;
        }

        .page-heading p { color: #8993a6; font-size: 13px; margin-top: 7px; }

        .date-chip {
            background: white;
            border: 1px solid #e7eaf1;
            border-radius: 9px;
            padding: 11px 15px;
            font-size: 12px;
            color: #67748c;
        }

        .welcome-card {
            background: linear-gradient(110deg, #253e6a, #5277d7);
            border-radius: 16px;
            padding: 27px 30px;
            color: white;
            margin-bottom: 27px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card h2 { font-size: 22px; margin: 0 0 9px; }
        .welcome-card p { color: #e1e9ff; font-size: 13px; margin: 0; }

        .welcome-decoration {
            position: absolute;
            right: 35px;
            top: -32px;
            font-size: 125px;
            opacity: .12;
        }

        .section-title { font-size: 16px; font-weight: 700; margin: 28px 0 17px; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .stat-card {
            background: white;
            border: 1px solid #edf0f5;
            border-radius: 13px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(32, 43, 67, .03);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 19px;
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            border-radius: 11px;
            display: grid;
            place-items: center;
            font-size: 20px;
        }

        .blue-icon { background: #e8efff; }
        .green-icon { background: #e4f7ed; }
        .orange-icon { background: #fff1df; }

        .stat-label { color: #8a95a8; font-size: 12px; }

        .stat-number {
            font-size: 27px;
            font-weight: 750;
            color: #202b43;
            margin-top: 7px;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 17px;
        }

        .quick-card {
            background: white;
            border: 1px solid #edf0f5;
            border-radius: 13px;
            padding: 21px;
            text-decoration: none;
            color: #202b43;
            transition: .2s;
        }

        .quick-card:hover {
            border-color: #8da8ed;
            transform: translateY(-2px);
        }

        .quick-card h3 { font-size: 15px; margin: 12px 0 7px; }
        .quick-card p { color: #8993a6; font-size: 12px; margin: 0; }
        .quick-icon { font-size: 24px; }

        .alert-success {
            background: #e6f7ed;
            color: #187747;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        @media(max-width: 900px) {
            .sidebar { width: 215px; }
            .content-area { padding: 25px 20px; }
            .stats-grid { grid-template-columns: 1fr; }
        }

        @media(max-width: 650px) {
            .app-shell { flex-direction: column; }
            .sidebar { width: 100%; padding: 15px; }
            .brand { padding-bottom: 15px; }
            .sidebar-menu { flex-direction: row; flex-wrap: wrap; }
            .menu-label { display: none; }
            .menu-link { padding: 9px; font-size: 12px; }
            .sidebar-bottom { display: flex; align-items: center; padding-top: 10px; }
            .user-sidebar { flex: 1; }
            .logout-button { width: auto; }
            .topbar { padding: 15px 18px; }
            .content-area { padding: 22px 16px; }
            .quick-grid { grid-template-columns: 1fr; }
            .date-chip { display: none; }
            .welcome-decoration { right: 10px; }
        }
    </style>
</head>

<body>
<div class="app-shell">

    <aside class="sidebar">

        <a href="{{ route('dashboard') }}" class="brand">
            <div class="brand-icon">B</div>
            <div>
                <div class="brand-name">BookManager</div>
                <div class="brand-subtitle">Library Management System</div>
            </div>
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <nav class="sidebar-menu">

            <a href="{{ route('dashboard') }}"
               class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="menu-icon">▦</span> Dashboard
            </a>

            @can('lihat buku')
            <a href="{{ route('books.index') }}"
               class="menu-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                <span class="menu-icon">▤</span> Daftar Buku
            </a>
            @endcan

            @can('kelola role')
            <a href="{{ route('users.index') }}"
               class="menu-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <span class="menu-icon">♙</span> Kelola Pengguna
            </a>
            @endcan

        </nav>

        <div class="sidebar-bottom">

            <div class="user-sidebar">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">
                        {{ auth()->user()->getRoleNames()->first() ?? 'Pengguna' }}
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    ↪ &nbsp; Keluar dari Aplikasi
                </button>
            </form>

        </div>

    </aside>

    <div class="main-area">

        <header class="topbar">
            <div>
                <div class="topbar-title">Manajemen Buku</div>
                <div class="topbar-subtitle">
                    Sistem Informasi Pengelolaan Buku
                </div>
            </div>

            <div class="topbar-profile">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="profile-name">{{ auth()->user()->name }}</div>
                    <div class="profile-role">
                        {{ auth()->user()->getRoleNames()->first() ?? 'Pengguna' }}
                    </div>
                </div>
            </div>
        </header>

        <main class="content-area">

            @if(session('success'))
                <div class="alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            {{ $slot }}

        </main>

    </div>
</div>
</body>
</html>
