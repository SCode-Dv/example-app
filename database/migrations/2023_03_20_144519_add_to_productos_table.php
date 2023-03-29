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
        Schema::table('productos', function (Blueprint $table) {
            $table->string('codigo', 20)->unique()->change();/* con change es realizar un cambio en una columan
            y no se confunda con crear una nueva calumna */
            $table->text('descripcion')->nullable()->change();

            $table->foreignId('categoria_id')
            ->constrained('categorias')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            /*$table->after('existencia', function($table) {
                $table->foreignId('categoria_id')->constrained('categorias')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            });*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign('productos_categoria_id_foreign');
            $table->dropColumn('categoria_id');
            $table->dropUnique('productos_codigo_unique');
        });
    }
};
