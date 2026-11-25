<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('topic');
            $table->foreignId('topic_id')->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropConstrainedForeignId('topic_id');
            $table->string('topic')->default('');
        });
    }
};
