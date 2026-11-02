<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\RolePermissionSeeder;

class BookPermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    private function buatBuku(): Book
    {
        return Book::create([
            'judul' => 'Buku Percobaan',
            'penulis' => 'Penulis Test',
            'penerbit' => 'Penerbit Test',
            'tahun_terbit' => 2024,
            'stok' => 5,
            'deskripsi' => 'Buku untuk pengujian permission',
        ]);
    }

    // ADMIN: boleh menghapus buku
    public function test_admin_dapat_menghapus_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');

        $book = $this->buatBuku();

        $response = $this->actingAs($user)
            ->delete(route('books.destroy', $book));

        $response->assertRedirect(route('books.index'));

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }

    // DOSEN: tidak boleh menghapus buku
    public function test_dosen_tidak_dapat_menghapus_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Dosen');

        $book = $this->buatBuku();

        $response = $this->actingAs($user)
            ->delete(route('books.destroy', $book));

        $response->assertForbidden();

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
        ]);
    }

    // MAHASISWA: tidak boleh menghapus buku
    public function test_mahasiswa_tidak_dapat_menghapus_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Mahasiswa');

        $book = $this->buatBuku();

        $response = $this->actingAs($user)
            ->delete(route('books.destroy', $book));

        $response->assertForbidden();

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
        ]);
    }

    // DOSEN: boleh menambahkan buku
    public function test_dosen_dapat_menambahkan_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Dosen');

        $response = $this->actingAs($user)
            ->post(route('books.store'), [
                'judul' => 'Buku Laravel',
                'penulis' => 'Penulis Test',
                'penerbit' => 'Penerbit Test',
                'tahun_terbit' => 2024,
                'stok' => 10,
                'deskripsi' => 'Buku untuk pengujian',
            ]);

        $response->assertRedirect(route('books.index'));

        $this->assertDatabaseHas('books', [
            'judul' => 'Buku Laravel',
            'penulis' => 'Penulis Test',
        ]);
    }

    // DOSEN: boleh mengedit buku
    public function test_dosen_dapat_mengedit_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Dosen');

        $book = $this->buatBuku();

        $response = $this->actingAs($user)
            ->put(route('books.update', $book), [
                'judul' => 'Buku Laravel Diperbarui',
                'penulis' => 'Penulis Baru',
                'penerbit' => 'Penerbit Baru',
                'tahun_terbit' => 2025,
                'stok' => 15,
                'deskripsi' => 'Data buku telah diperbarui',
            ]);

        $response->assertRedirect(route('books.index'));

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'judul' => 'Buku Laravel Diperbarui',
        ]);
    }

    // MAHASISWA: tidak boleh menambahkan buku
    public function test_mahasiswa_tidak_dapat_menambahkan_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Mahasiswa');

        $response = $this->actingAs($user)
            ->post(route('books.store'), [
                'judul' => 'Buku Terlarang',
                'penulis' => 'Penulis Test',
                'penerbit' => 'Penerbit Test',
                'tahun_terbit' => 2024,
                'stok' => 5,
                'deskripsi' => 'Percobaan mahasiswa',
            ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('books', [
            'judul' => 'Buku Terlarang',
        ]);
    }

    // MAHASISWA: tidak boleh mengedit buku
    public function test_mahasiswa_tidak_dapat_mengedit_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Mahasiswa');

        $book = $this->buatBuku();

        $response = $this->actingAs($user)
            ->put(route('books.update', $book), [
                'judul' => 'Buku yang Diubah Mahasiswa',
                'penulis' => 'Penulis Baru',
                'penerbit' => 'Penerbit Baru',
                'tahun_terbit' => 2025,
                'stok' => 20,
                'deskripsi' => 'Percobaan perubahan data',
            ]);

        $response->assertForbidden();

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'judul' => 'Buku Percobaan',
        ]);
    }
}
