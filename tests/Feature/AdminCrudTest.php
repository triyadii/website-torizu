<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lead;
use App\Models\User;
use App\Models\VarianBarang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $superadmin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superadmin = User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@fashionbaju.com',
            'username' => 'superadmin',
            'password' => Hash::make('password123'),
            'role' => 'superadmin',
        ]);
    }

    /**
     * Test public catalog renders correctly and direct login is removed.
     */
    public function test_public_catalog_displays_without_direct_login_link(): void
    {
        $kategori = Kategori::create([
            'nama' => 'Kaos Test',
            'slug' => 'kaos-test',
        ]);

        $barang = Barang::create([
            'kategori_id' => $kategori->id,
            'nama' => 'Kaos Luffy King',
            'deskripsi' => 'Bahan 100% Cotton 24s',
            'harga' => 149000,
            'foto_utama' => '/images/produk/luffy-one-piece.jpg',
            'status' => 'aktif',
        ]);

        VarianBarang::create([
            'barang_id' => $barang->id,
            'ukuran' => 'L',
            'warna' => 'Hitam',
            'stok' => 50,
        ]);

        $response = $this->get(route('catalog.index'));

        $response->assertStatus(200);
        $response->assertSee('TORIZU');
        $response->assertSee('Kaos Luffy King');
        // Verify direct login link was removed from customer view
        $response->assertDontSee('Dashboard Staf Internal');
        $response->assertDontSee(route('admin.login'));
    }

    /**
     * Test admin authentication guard.
     */
    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * Test full Kategori CRUD operations.
     */
    public function test_kategori_crud_lifecycle(): void
    {
        // 1. Index
        $response = $this->actingAs($this->superadmin)->get(route('admin.kategori.index'));
        $response->assertStatus(200);

        // 2. Create / Store
        $storeResponse = $this->actingAs($this->superadmin)->post(route('admin.kategori.store'), [
            'nama' => 'Jaket Anime Bomber',
            'slug' => 'jaket-anime-bomber',
        ]);
        $storeResponse->assertRedirect(route('admin.kategori.index'));
        $this->assertDatabaseHas('kategori', [
            'nama' => 'Jaket Anime Bomber',
            'slug' => 'jaket-anime-bomber',
        ]);

        $kategori = Kategori::where('slug', 'jaket-anime-bomber')->firstOrFail();

        // 3. Edit Form
        $editResponse = $this->actingAs($this->superadmin)->get(route('admin.kategori.edit', $kategori->id));
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Jaket Anime Bomber');

        // 4. Update
        $updateResponse = $this->actingAs($this->superadmin)->put(route('admin.kategori.update', $kategori->id), [
            'nama' => 'Jaket Anime Bomber Premium',
            'slug' => 'jaket-anime-bomber-premium',
        ]);
        $updateResponse->assertRedirect(route('admin.kategori.index'));
        $this->assertDatabaseHas('kategori', [
            'id' => $kategori->id,
            'nama' => 'Jaket Anime Bomber Premium',
        ]);

        // 5. Delete
        $deleteResponse = $this->actingAs($this->superadmin)->delete(route('admin.kategori.destroy', $kategori->id));
        $deleteResponse->assertRedirect(route('admin.kategori.index'));
        $this->assertDatabaseMissing('kategori', ['id' => $kategori->id]);
    }

    /**
     * Test full Barang and Varian CRUD operations.
     */
    public function test_barang_and_varian_crud_lifecycle(): void
    {
        $kategori = Kategori::create([
            'nama' => 'Hoodie Streetwear',
            'slug' => 'hoodie-streetwear',
        ]);

        // 1. Index
        $indexResponse = $this->actingAs($this->superadmin)->get(route('admin.barang.index'));
        $indexResponse->assertStatus(200);

        // 2. Store Barang with Variants
        $storeResponse = $this->actingAs($this->superadmin)->post(route('admin.barang.store'), [
            'kategori_id' => $kategori->id,
            'nama' => 'Hoodie Sukuna Jujutsu',
            'deskripsi' => 'Hoodie fleece tebal premium sablon DTF',
            'harga' => 249000,
            'foto_url_input' => 'https://example.com/sukuna.jpg',
            'status' => 'aktif',
            'varians' => [
                ['ukuran' => 'M', 'warna' => 'Hitam', 'stok' => 25],
                ['ukuran' => 'L', 'warna' => 'Hitam', 'stok' => 30],
            ],
        ]);
        $storeResponse->assertRedirect(route('admin.barang.index'));
        $this->assertDatabaseHas('barang', [
            'nama' => 'Hoodie Sukuna Jujutsu',
            'status' => 'aktif',
        ]);

        $barang = Barang::where('nama', 'Hoodie Sukuna Jujutsu')->firstOrFail();
        $this->assertEquals(55, $barang->total_stok);

        // 3. Edit Form
        $editResponse = $this->actingAs($this->superadmin)->get(route('admin.barang.edit', $barang->id));
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Hoodie Sukuna Jujutsu');

        // 4. Update Barang
        $updateResponse = $this->actingAs($this->superadmin)->put(route('admin.barang.update', $barang->id), [
            'kategori_id' => $kategori->id,
            'nama' => 'Hoodie Sukuna Jujutsu Kaisen V2',
            'deskripsi' => 'Deskripsi diperbarui',
            'harga' => 259000,
            'status' => 'aktif',
        ]);
        $updateResponse->assertRedirect(route('admin.barang.index'));
        $this->assertDatabaseHas('barang', [
            'id' => $barang->id,
            'nama' => 'Hoodie Sukuna Jujutsu Kaisen V2',
            'harga' => 259000,
        ]);

        // 5. Add new Varian
        $addVarianResponse = $this->actingAs($this->superadmin)->post(route('admin.barang.varian.store', $barang->id), [
            'ukuran' => 'XL',
            'warna' => 'Crimson Red',
            'stok' => 15,
        ]);
        $addVarianResponse->assertRedirect();
        $this->assertDatabaseHas('varian_barang', [
            'barang_id' => $barang->id,
            'ukuran' => 'XL',
            'warna' => 'Crimson Red',
            'stok' => 15,
        ]);

        $newVarian = VarianBarang::where('barang_id', $barang->id)->where('ukuran', 'XL')->firstOrFail();

        // 6. Update Varian
        $updateVarianResponse = $this->actingAs($this->superadmin)->put(route('admin.barang.varian.update', [
            'barangId' => $barang->id,
            'varianId' => $newVarian->id,
        ]), [
            'stok' => 40,
        ]);
        $updateVarianResponse->assertRedirect();
        $this->assertDatabaseHas('varian_barang', [
            'id' => $newVarian->id,
            'stok' => 40,
        ]);

        // 7. Delete Varian
        $deleteVarianResponse = $this->actingAs($this->superadmin)->delete(route('admin.barang.varian.destroy', [
            'barangId' => $barang->id,
            'varianId' => $newVarian->id,
        ]));
        $deleteVarianResponse->assertRedirect();
        $this->assertDatabaseMissing('varian_barang', ['id' => $newVarian->id]);

        // 8. Delete Barang
        $deleteBarangResponse = $this->actingAs($this->superadmin)->delete(route('admin.barang.destroy', $barang->id));
        $deleteBarangResponse->assertRedirect(route('admin.barang.index'));
        $this->assertDatabaseMissing('barang', ['id' => $barang->id]);
    }

    /**
     * Test Leads tracking and management.
     */
    public function test_leads_lifecycle(): void
    {
        $kategori = Kategori::create(['nama' => 'Kaos', 'slug' => 'kaos']);
        $barang = Barang::create([
            'kategori_id' => $kategori->id,
            'nama' => 'Kaos Zoro Onigiri',
            'deskripsi' => 'Kaos anime One Piece',
            'harga' => 149000,
            'foto_utama' => '/images/produk/luffy-one-piece.jpg',
            'status' => 'aktif',
        ]);
        $varian = VarianBarang::create([
            'barang_id' => $barang->id,
            'ukuran' => 'L',
            'warna' => 'Hitam',
            'stok' => 20,
        ]);

        // 1. Customer places order via WA -> Lead is logged
        $orderResponse = $this->post(route('catalog.orderWa', $barang->id), [
            'nama_pemesan' => 'Roronoa Customer',
            'nomor_wa' => '081234567899',
            'varian_id' => $varian->id,
        ]);
        $orderResponse->assertRedirect();
        $this->assertDatabaseHas('leads', [
            'barang_id' => $barang->id,
            'nama_pemesan' => 'Roronoa Customer',
            'status' => 'klik_wa',
        ]);

        $lead = Lead::where('nama_pemesan', 'Roronoa Customer')->firstOrFail();

        // 2. Admin views Leads list
        $leadsIndexResponse = $this->actingAs($this->superadmin)->get(route('admin.leads.index'));
        $leadsIndexResponse->assertStatus(200);
        $leadsIndexResponse->assertSee('Roronoa Customer');

        // 3. Admin updates Lead status to closing
        $patchStatusResponse = $this->actingAs($this->superadmin)->patch(route('admin.leads.updateStatus', $lead->id), [
            'status' => 'closing',
        ]);
        $patchStatusResponse->assertRedirect();
        $this->assertDatabaseHas('leads', [
            'id' => $lead->id,
            'status' => 'closing',
        ]);

        // 4. Admin deletes Lead
        $deleteLeadResponse = $this->actingAs($this->superadmin)->delete(route('admin.leads.destroy', $lead->id));
        $deleteLeadResponse->assertRedirect();
        $this->assertDatabaseMissing('leads', ['id' => $lead->id]);
    }

    /**
     * Test Users management (CRUD by superadmin).
     */
    public function test_users_management(): void
    {
        // 1. Superadmin views user management
        $response = $this->actingAs($this->superadmin)->get(route('admin.users.index'));
        $response->assertStatus(200);
        $response->assertSee('superadmin');

        // 2. Superadmin creates a new admin user
        $createResponse = $this->actingAs($this->superadmin)->post(route('admin.users.store'), [
            'name' => 'Staf Baru',
            'username' => 'stafbaru',
            'email' => 'stafbaru@fashionbaju.com',
            'password' => 'secret12345',
            'password_confirmation' => 'secret12345',
            'role' => 'admin',
        ]);
        $createResponse->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'username' => 'stafbaru',
            'email' => 'stafbaru@fashionbaju.com',
            'role' => 'admin',
        ]);

        $newUser = User::where('username', 'stafbaru')->firstOrFail();

        // 3. Superadmin deletes the admin user
        $deleteResponse = $this->actingAs($this->superadmin)->delete(route('admin.users.destroy', $newUser->id));
        $deleteResponse->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', ['id' => $newUser->id]);
    }
}
