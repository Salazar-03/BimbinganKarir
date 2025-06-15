<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
        */
        public function up()
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->softDeletes(); // Ini akan menambahkan kolom deleted_at
        });
    }

    public function down()
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Menghapus kolom deleted_at saat rollback
        });
    }
};
