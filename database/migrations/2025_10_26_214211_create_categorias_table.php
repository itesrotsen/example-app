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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->string('slug', 120)->unique();
            $table->text('descripcion')->nullable();
            $table->string('icono', 50)->nullable(); // Icono o emoji para la categoría
            $table->string('color', 7)->default('#000000'); // Color en hexadecimal
            $table->integer('orden')->default(0); // Orden de visualización
            $table->unsignedBigInteger('categoria_padre_id')->nullable(); // Para subcategorías
            $table->boolean('activo')->default(true);
            $table->integer('cantidad_productos')->default(0); // Contador de productos
            $table->timestamps();
            $table->softDeletes(); // Borrado suave
            
            // Índices y relaciones
            $table->foreign('categoria_padre_id')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('set null');
            
            $table->index('slug');
            $table->index('activo');
            $table->index('orden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
