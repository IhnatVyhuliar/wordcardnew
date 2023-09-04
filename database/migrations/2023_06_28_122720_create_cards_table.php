<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Folder;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->string('translation')->charset('utf8');
            $table->string('definition');
            //$table->foreignId(User::class)->onDelete('cascade');
            //$table->foreignId(Folder::class)->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Folder::class)->constrained()->onDelete('cascade');
            $table->boolean('favorite')->default(0);
            $table->string('image')->nullable();
            $table->enum('level', ['0','1','2','3','4'])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
