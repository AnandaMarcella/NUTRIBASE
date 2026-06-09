<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('isi_tanggapan');
        });
    }

    public function down()
    {
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
