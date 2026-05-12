<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        $mobils = [
            ['nama_mobil'=>'Toyota Avanza','buatan'=>'Toyota','tahun'=>2022,'harga_sewa'=>350000,'status'=>'tersedia','deskripsi'=>'Mobil keluarga nyaman untuk 7 penumpang.'],
            ['nama_mobil'=>'Honda Brio','buatan'=>'Honda','tahun'=>2023,'harga_sewa'=>280000,'status'=>'tersedia','deskripsi'=>'Mobil city car yang irit dan lincah.'],
            ['nama_mobil'=>'Suzuki Ertiga','buatan'=>'Suzuki','tahun'=>2022,'harga_sewa'=>320000,'status'=>'tersedia','deskripsi'=>'MPV keluarga dengan kabin luas.'],
            ['nama_mobil'=>'Daihatsu Xenia','buatan'=>'Daihatsu','tahun'=>2021,'harga_sewa'=>300000,'status'=>'tersedia','deskripsi'=>'MPV serbaguna dengan harga terjangkau.'],
            ['nama_mobil'=>'Mitsubishi Pajero','buatan'=>'Mitsubishi','tahun'=>2023,'harga_sewa'=>750000,'status'=>'tersedia','deskripsi'=>'SUV tangguh cocok untuk segala medan.'],
        ];
        foreach ($mobils as $m) {
            DB::table('t_mobil')->insert(array_merge($m, ['created_at'=>now(),'updated_at'=>now()]));
        }
    }
}
