<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('photo_media_id')->nullable()->after('phone');
            $table->integer('signature_media_id')->nullable()->after('photo_media_id');
            $table->integer('doc_media_id')->nullable()->after('signature_media_id');
            $table->string('address')->nullable()->after('doc_media_id');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo_media_id');
            $table->dropColumn('signature_media_id');
            $table->dropColumn('doc_media_id');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('state');
        });
    }
};
