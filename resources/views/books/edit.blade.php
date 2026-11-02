<x-app-layout>

    <style>
        .form-heading {
            margin-bottom: 25px;
        }

        .form-heading h1 {
            font-size: 25px;
            font-weight: 750;
            color: #202b43;
        }

        .form-heading p {
            color: #8993a6;
            font-size: 13px;
            margin-top: 7px;
        }

        .form-card {
            background: white;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 28px;
            max-width: 850px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full { grid-column: 1 / -1; }

        .form-group label {
            font-size: 13px;
            font-weight: 650;
            color: #35415a;
        }

        .form-control {
            width: 100%;
            border: 1px solid #dfe4ed;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 13px;
            outline: none;
            color: #35415a;
            background: white;
        }

        .form-control:focus {
            border-color: #5277d7;
            box-shadow: 0 0 0 3px #5277d71a;
        }

        textarea.form-control {
            min-height: 110px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #edf0f5;
        }

        .btn-save, .btn-cancel {
            padding: 11px 19px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 650;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-save {
            border: none;
            background: #4169c9;
            color: white;
        }

        .btn-save:hover { background: #304f9d; }

        .btn-cancel {
            background: #f1f3f7;
            color: #59657b;
        }

        .error-text {
            color: #d34c4c;
            font-size: 11px;
        }

        @media(max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: auto; }
            .form-card { padding: 18px; }
        }
    </style>

    <div class="form-heading">
        <h1>Edit Buku</h1>
        <p>Perbarui informasi buku yang sudah terdaftar.</p>
    </div>

    <div class="form-card">

        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group full">
                    <label>Judul Buku *</label>
                    <input type="text" name="judul"
                        class="form-control"
                        value="{{ old('judul', $book->judul) }}"
                        required>
                    @error('judul')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Penulis *</label>
                    <input type="text" name="penulis"
                        class="form-control"
                        value="{{ old('penulis', $book->penulis) }}"
                        required>
                    @error('penulis')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit"
                        class="form-control"
                        value="{{ old('penerbit', $book->penerbit) }}">
                    @error('penerbit')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit"
                        class="form-control"
                        value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                        min="1000" max="9999">
                    @error('tahun_terbit')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Stok Buku *</label>
                    <input type="number" name="stok"
                        class="form-control"
                        value="{{ old('stok', $book->stok) }}"
                        min="0" required>
                    @error('stok')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group full">
                    <label>Deskripsi Buku</label>
                    <textarea name="deskripsi"
                        class="form-control">{{ old('deskripsi', $book->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('books.index') }}" class="btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn-save">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
