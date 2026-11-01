<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lead;
use App\Models\User;
use App\Models\VarianBarang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FashionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin Users
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Super Administrator',
                'email' => 'admin@fashionbaju.com',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
            ]
        );

        User::firstOrCreate(
            ['username' => 'staf'],
            [
                'name' => 'Staf Operasional',
                'email' => 'staf@fashionbaju.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Kategori Anime Streetwear
        $katTshirt = Kategori::create([
            'nama' => 'Kaos Oversized',
            'slug' => 'kaos-oversized',
        ]);

        $katHoodie = Kategori::create([
            'nama' => 'Hoodie & Crewneck',
            'slug' => 'hoodie-crewneck',
        ]);

        $katOuter = Kategori::create([
            'nama' => 'Haori & Jaket',
            'slug' => 'haori-jaket',
        ]);

        $katCelana = Kategori::create([
            'nama' => 'Celana Techwear',
            'slug' => 'celana-techwear',
        ]);

        // 3. Produk Anime

        // Produk 1: One Piece Luffy King of Pirates (Sesuai foto user)
        $b1 = Barang::create([
            'kategori_id' => $katTshirt->id,
            'nama' => 'Kaos Anime Luffy King of Pirates Oversized',
            'deskripsi' => "Kaos graphic anime streetwear bertema Monkey D. Luffy Gear 5 & King of the Pirates dengan style street-graffiti khas Jepang. Dibuat menggunakan bahan katun heavyweight premium 24s yang tebal, adem, dan menyerap keringat.\n\nDetail Spesifikasi:\n- Material: 100% Cotton Combed 24s Heavyweight\n- Sablon: Direct-to-Film (DTF) High Definition, tahan cuci berkali-kali\n- Fitting: Boxy Oversized Streetwear Cut\n- Kerah: Ribbed Collar elastis anti-melar\n- Sablon grafis vibrant full-color dengan aksen brush stroke & kanji.",
            'harga' => 149000,
            'foto_utama' => '/images/produk/luffy-one-piece.jpg',
            'status' => 'aktif',
        ]);

        VarianBarang::create(['barang_id' => $b1->id, 'warna' => 'Jet Black', 'ukuran' => 'M', 'stok' => 20]);
        $v1_l = VarianBarang::create(['barang_id' => $b1->id, 'warna' => 'Jet Black', 'ukuran' => 'L', 'stok' => 35]);
        VarianBarang::create(['barang_id' => $b1->id, 'warna' => 'Jet Black', 'ukuran' => 'XL', 'stok' => 25]);
        VarianBarang::create(['barang_id' => $b1->id, 'warna' => 'Jet Black', 'ukuran' => 'XXL', 'stok' => 12]);
        VarianBarang::create(['barang_id' => $b1->id, 'warna' => 'Vintage Wash', 'ukuran' => 'L', 'stok' => 15]);

        // Produk 2: Jujutsu Kaisen Gojo Satoru Hollow Purple
        $b2 = Barang::create([
            'kategori_id' => $katTshirt->id,
            'nama' => 'Kaos Anime Gojo Satoru Domain Expansion',
            'deskripsi' => "Kaos oversized bertema Satoru Gojo dengan teknik Muryokusho (Infinite Void). Grafis neon ungu-cyan menyala dengan tipografi kanji tebal di bagian dada dan punggung.\n\nDetail Spesifikasi:\n- Material: 100% Cotton Combed 24s Super Soft\n- Sablon: Premium DTF Printing dengan saturasi warna tajam\n- Fitting: Modern Streetwear Loose Fit\n- Jahitan: Jahit rantai pundak standar distro clothing line\n- Tag label woven Torizu authentic merchandise.",
            'harga' => 149000,
            'foto_utama' => '/images/produk/gojo-satoru.jpg',
            'status' => 'aktif',
        ]);

        $v2_m = VarianBarang::create(['barang_id' => $b2->id, 'warna' => 'Pitch Black', 'ukuran' => 'M', 'stok' => 18]);
        VarianBarang::create(['barang_id' => $b2->id, 'warna' => 'Pitch Black', 'ukuran' => 'L', 'stok' => 28]);
        VarianBarang::create(['barang_id' => $b2->id, 'warna' => 'Pitch Black', 'ukuran' => 'XL', 'stok' => 16]);
        VarianBarang::create(['barang_id' => $b2->id, 'warna' => 'Pitch Black', 'ukuran' => 'XXL', 'stok' => 7]);

        // Produk 3: Akatsuki Red Cloud Streetwear Hoodie
        $b3 = Barang::create([
            'kategori_id' => $katHoodie->id,
            'nama' => 'Hoodie Akatsuki Cloud Vintage Japanese Streetwear',
            'deskripsi' => "Hoodie pullover bertema klan Akatsuki dengan bordir timbul (embroidery) awan merah ikonik dan patch kanji Jepang. Bagian dalam tudung dilapisi kain merah kontras yang sangat keren.\n\nDetail Spesifikasi:\n- Material: Heavyweight Cotton Fleece 330 GSM (Sangat hangat & empuk)\n- Aplikasi: Bordir komputer presisi tinggi (3D Embroidery)\n- Tali hoodie bulat tebal dengan besi aglet metalik\n- Saku kangaroo luas di bagian depan\n- Rib pinggang dan lengan elastis premium.",
            'harga' => 269000,
            'foto_utama' => '/images/produk/akatsuki-hoodie.jpg',
            'status' => 'aktif',
        ]);

        VarianBarang::create(['barang_id' => $b3->id, 'warna' => 'Black / Crimson', 'ukuran' => 'M', 'stok' => 12]);
        $v3_l = VarianBarang::create(['barang_id' => $b3->id, 'warna' => 'Black / Crimson', 'ukuran' => 'L', 'stok' => 22]);
        VarianBarang::create(['barang_id' => $b3->id, 'warna' => 'Black / Crimson', 'ukuran' => 'XL', 'stok' => 15]);

        // Produk 4: Levi Ackerman Survey Corps Vintage Tee
        $b4 = Barang::create([
            'kategori_id' => $katTshirt->id,
            'nama' => 'Kaos Attack on Titan Levi Ackerman Wings of Freedom',
            'deskripsi' => "Kaos vintage acid-washed bernuansa gritty khas Attack on Titan. Grafis Kapten Levi dengan emblem Sayap Kebebasan (Wings of Freedom) warna emerald green yang memukau.\n\nDetail Spesifikasi:\n- Material: 100% Pre-shrunk Cotton Vintage Washed (Tekstur lembut & adem)\n- Warna bahan: Vintage Charcoal Washed\n- Sablon: Plastisol High-Density discharge feel\n- Fitting: Relaxed Drop-shoulder\n- Nyaman dipakai nongkrong, festival anime, atau outfit harian.",
            'harga' => 159000,
            'foto_utama' => '/images/produk/levi-ackerman.jpg',
            'status' => 'aktif',
        ]);

        VarianBarang::create(['barang_id' => $b4->id, 'warna' => 'Vintage Charcoal', 'ukuran' => 'M', 'stok' => 15]);
        VarianBarang::create(['barang_id' => $b4->id, 'warna' => 'Vintage Charcoal', 'ukuran' => 'L', 'stok' => 24]);
        VarianBarang::create(['barang_id' => $b4->id, 'warna' => 'Vintage Charcoal', 'ukuran' => 'XL', 'stok' => 18]);

        // Produk 5: Haori Kimono Modern Cyberpunk
        $b5 = Barang::create([
            'kategori_id' => $katOuter->id,
            'nama' => 'Haori Kimono Modern Cyberpunk Great Wave',
            'deskripsi' => "Outer cardigan modern bergaya Kimono Haori tradisional Jepang dengan sentuhan cyberpunk kanji merah neon dan ombak Seigaiha. Cocok dipakai sebagai layering streetwear di atas kaos polos atau grafis.\n\nDetail Spesifikasi:\n- Material: Premium Cotton Twill breathable & ringan\n- Grafis: Sublimation HD tidak luntur\n- Lengan 3/4 khas Haori tradisional\n- Tali pengikat dada aktif\n- Tampilan unisex untuk cowok maupun cewek.",
            'harga' => 229000,
            'foto_utama' => '/images/produk/haori-kimono.jpg',
            'status' => 'aktif',
        ]);

        VarianBarang::create(['barang_id' => $b5->id, 'warna' => 'Black Wave Red', 'ukuran' => 'All Size M-L', 'stok' => 16]);
        VarianBarang::create(['barang_id' => $b5->id, 'warna' => 'Black Wave Red', 'ukuran' => 'All Size XL-XXL', 'stok' => 14]);

        // Produk 6: Celana Techwear Cargo Torizu
        $b6 = Barang::create([
            'kategori_id' => $katCelana->id,
            'nama' => 'Celana Techwear Cargo Cyberpunk Multi-Pocket',
            'deskripsi' => "Celana panjang techwear cargo streetwear dengan buckle strap tali gantung dan aksen kanji reflective. Sangat pas dipadukan dengan kaos anime oversized untuk look wibu streetwear hypebeast.\n\nDetail Spesifikasi:\n- Material: Katun Twill Stretch tebal & elastis\n- 6 Saku fungsional (2 samping, 2 kargo flap, 2 belakang)\n- Strap buckle nilon tactical yang bisa dilepas-pasang\n- Ujung celana model jogger rib karet elastis\n- Pinggang karet dengan tali serut kokoh.",
            'harga' => 219000,
            'foto_utama' => '/images/produk/cargo-pants.jpg',
            'status' => 'aktif',
        ]);

        VarianBarang::create(['barang_id' => $b6->id, 'warna' => 'Matte Black', 'ukuran' => 'M (29-30)', 'stok' => 14]);
        VarianBarang::create(['barang_id' => $b6->id, 'warna' => 'Matte Black', 'ukuran' => 'L (31-32)', 'stok' => 20]);
        VarianBarang::create(['barang_id' => $b6->id, 'warna' => 'Matte Black', 'ukuran' => 'XL (33-34)', 'stok' => 12]);

        // 4. Sample Leads
        Lead::create([
            'nama_pemesan' => 'Rian Pratama',
            'nomor_wa' => '081298765432',
            'barang_id' => $b1->id,
            'varian_id' => $v1_l->id,
            'status' => 'closing',
            'created_at' => now()->subHours(3),
        ]);

        Lead::create([
            'nama_pemesan' => 'Bayu Wicaksono',
            'nomor_wa' => '085712348899',
            'barang_id' => $b2->id,
            'varian_id' => $v2_m->id,
            'status' => 'terhubung',
            'created_at' => now()->subHours(6),
        ]);

        Lead::create([
            'nama_pemesan' => 'Dimas Anggara',
            'nomor_wa' => '087811223344',
            'barang_id' => $b3->id,
            'varian_id' => $v3_l->id,
            'status' => 'klik_wa',
            'created_at' => now()->subMinutes(45),
        ]);
    }
}
