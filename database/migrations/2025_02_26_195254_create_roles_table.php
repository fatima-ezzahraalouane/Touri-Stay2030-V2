<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DO $$ BEGIN 
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'role_user') THEN
                CREATE TYPE role_user AS ENUM ('Admin', 'Tourist', 'Owner');
            END IF;
        END $$;");
    
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->enum('name_user', ['Admin', 'Tourist', 'Owner'])->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        DB::statement("DROP TYPE role_user");
    }
};
