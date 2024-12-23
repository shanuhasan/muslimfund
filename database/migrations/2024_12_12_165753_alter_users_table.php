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
            $table->string('guid', 36)->unique()->nullable()->after('id');
            $table->integer('role_id')->nullable()->after('guid');
            $table->tinyInteger('status')->nullable()->default(1)->after('remember_token');
            $table->tinyInteger('is_deleted')->nullable()->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('guid');
            $table->dropColumn('status');
            $table->dropColumn('role_id');
            $table->dropColumn('is_deleted');
        });
    }
};
