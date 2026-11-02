<x-app-layout>

    <style>
        .users-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .users-heading h1 {
            font-size: 25px;
            font-weight: 750;
            color: #202b43;
            margin: 0;
        }

        .users-heading p {
            color: #8993a6;
            font-size: 13px;
            margin-top: 7px;
        }

        .user-summary {
            background: white;
            border: 1px solid #edf0f5;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 22px;
        }

        .user-summary span {
            color: #8993a6;
            font-size: 12px;
        }

        .user-summary strong {
            display: block;
            font-size: 25px;
            margin-top: 7px;
            color: #202b43;
        }

        .users-card {
            background: white;
            border: 1px solid #edf0f5;
            border-radius: 13px;
            overflow: hidden;
        }

        .users-card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #edf0f5;
        }

        .users-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .users-card-header p {
            font-size: 12px;
            color: #8993a6;
            margin-top: 5px;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .users-table th {
            background: #f8f9fc;
            color: #7c879c;
            text-align: left;
            padding: 15px;
            font-size: 11px;
            text-transform: uppercase;
        }

        .users-table td {
            padding: 16px 15px;
            border-top: 1px solid #edf0f5;
            color: #536078;
            vertical-align: middle;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .user-avatar {
            width: 37px;
            height: 37px;
            border-radius: 50%;
            background: #e8efff;
            color: #4169c9;
            display: grid;
            place-items: center;
            font-weight: 700;
        }

        .user-fullname {
            font-weight: 650;
            color: #202b43;
        }

        .role-badge {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 650;
        }

        .role-admin {
            background: #e8efff;
            color: #4169c9;
        }

        .role-dosen {
            background: #e4f7ed;
            color: #218452;
        }

        .role-mahasiswa {
            background: #fff1df;
            color: #bd7924;
        }

        .role-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .role-select {
            padding: 9px 10px;
            border: 1px solid #dfe4ed;
            border-radius: 7px;
            background: white;
            color: #35415a;
            font-size: 12px;
        }

        .btn-update {
            background: #4169c9;
            color: white;
            border: none;
            border-radius: 7px;
            padding: 9px 12px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-update:hover {
            background: #304f9d;
        }

        .empty-users {
            padding: 40px;
            text-align: center;
            color: #8993a6;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media(max-width: 650px) {
            .users-heading {
                align-items: flex-start;
            }

            .role-form {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="users-heading">
        <div>
            <h1>Kelola Pengguna</h1>
            <p>Kelola akun dan hak akses pengguna aplikasi.</p>
        </div>
    </div>

    <div class="user-summary">
        <span>Total pengguna terdaftar</span>
        <strong>{{ $users->count() }} Pengguna</strong>
    </div>

    <div class="users-card">

        <div class="users-card-header">
            <h3>Data Pengguna</h3>
            <p>Daftar akun dan pengaturan role pengguna.</p>
        </div>

        <div class="table-responsive">
            <table class="users-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role Saat Ini</th>
                        <th>Ubah Role</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $index => $user)

                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <span class="user-fullname">
                                        {{ $user->name }}
                                    </span>
                                </div>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>
                                @php
                                    $currentRole = $user->getRoleNames()->first() ?? 'Belum ada';
                                @endphp

                                <span class="role-badge
                                    {{ $currentRole === 'Admin' ? 'role-admin' : '' }}
                                    {{ $currentRole === 'Dosen' ? 'role-dosen' : '' }}
                                    {{ $currentRole === 'Mahasiswa' ? 'role-mahasiswa' : '' }}">
                                    {{ $currentRole }}
                                </span>
                            </td>

                            <td>
                                <form action="{{ route('users.update', $user->id) }}"
                                      method="POST"
                                      class="role-form"
                                      onsubmit="return confirm('Yakin ingin mengubah role pengguna ini?')">

                                    @csrf
                                    @method('PUT')

                                    <select name="role" class="role-select" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $currentRole === $role->name ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn-update">
                                        Simpan
                                    </button>

                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">
                                <div class="empty-users">
                                    Belum ada pengguna terdaftar.
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</x-app-layout>
