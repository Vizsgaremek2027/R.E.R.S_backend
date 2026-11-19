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
        Schema::create('archived_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("original_user_id")->constrained(table: "users", column: "id");
            $table->string("name", 50);
            $table->string("email", 100);
            $table->enum("role", ["Resident", "Admin"]);
            $table->string("deleted_reason", 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_users');
    }
};
