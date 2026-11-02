<x-app-layout>

    <style>
        .books-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .books-heading h1 {
            font-size: 25px;
            font-weight: 750;
            color: #202b43;
            margin: 0;
        }

        .books-heading p {
            color: #8993a6;
            font-size: 13px;
            margin-top: 7px;
        }

        .btn-add {
            background: #4169c9;
            color: white;
            padding: 12px 17px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .btn-add:hover { background: #304f9d; }

        .books-summary {
            background: white;
            border: 1px solid #edf0f5;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 22px;
        }

        .books-summary span {
            color: #8993a6;
            font-size: 12px;
        }

        .books-summary strong {
            display: block;
            font-size: 25px;
            margin-top: 7px;
            color: #202b43;
        }

        .table-card {
            background: white;
            border: 1px solid #edf0f5;
            border-radius: 13px;
            overflow: hidden;
        }

        .table-header {
            padding: 20px 22px;
            border-bottom: 1px solid #edf0f5;
        }

        .table-header h3 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .table-header p {
            font-size: 12px;
            color: #8993a6;
            margin: 5px 0 0;
        }

        .book-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .book-table th {
            background: #f8f9fc;
            color: #7c879c;
            text-align: left;
            padding: 15px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .book-table td {
            padding: 16px 15px;
            border-top: 1px solid #edf0f5;
            color: #536078;
        }

        .book-title {
            color: #202b43;
            font-weight: 650;
        }

        .stock-badge {
            background: #e8efff;
            color: #4169c9;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 650;
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .btn-edit, .btn-delete {
            padding: 7px 11px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: #e8efff;
            color: #4169c9;
        }

        .btn-delete {
            background: #ffebeb;
            color: #d34c4c;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: #8993a6;
            font-size: 13px;
        }

        .table-responsive { overflow-x: auto; }

        @media(max-width: 650px) {
            .books-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="books-heading">
        <div>
            <h1>Daftar Buku</h1>
            <p>Kelola dan pantau seluruh koleksi buku dalam sistem.</p>
        </div>

        @can('tambah buku')
            <a href="{{ route('books.create') }}" class="btn-add">
                + Tambah Buku
            </a>
        @endcan
    </div>

    <div class="books-summary">
        <span>Total koleksi buku</span>
        <strong>{{ $books->count() }} Buku</strong>
    </div>

    <div class="table-card">

        <div class="table-header">
            <h3>Koleksi Buku</h3>
            <p>Informasi buku yang telah terdaftar.</p>
        </div>

        <div class="table-responsive">
            <table class="book-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($books as $index => $book)

                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <span class="book-title">
                                    {{ $book->judul }}
                                </span>
                            </td>

                            <td>{{ $book->penulis }}</td>

                            <td>{{ $book->penerbit ?? '-' }}</td>

                            <td>{{ $book->tahun_terbit ?? '-' }}</td>

                            <td>
                                <span class="stock-badge">
                                    {{ $book->stok }}
                                </span>
                            </td>

                            <td>
                                <div class="action-group">

                                    @can('edit buku')
                                        <a href="{{ route('books.edit', $book->id) }}"
                                           class="btn-edit">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('hapus buku')
                                        <form action="{{ route('books.destroy', $book->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div style="font-size:35px; margin-bottom:10px;">
                                        📚
                                    </div>
                                    <strong>Belum ada data buku</strong>
                                    <p>Data buku yang ditambahkan akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

</x-app-layout>
