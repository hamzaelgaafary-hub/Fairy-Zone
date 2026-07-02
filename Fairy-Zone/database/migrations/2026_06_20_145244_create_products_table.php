<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('s_code')->nullable();//store code for the product
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(false);
            $table->integer('stock')->default(0);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
        /* هذا في حالة الموقع ضخم وفيه منتجات متداخله MANY TO MANY  وهذا موقع بسيط لذلك استخدمت foreign key مباشرة في جدول المنتجات        
        
        Schema::create('product_categories', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->primary(['product_id', 'category_id']);
            $table->timestamps();
        });
        */

    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('product_categories');
        Schema::dropIfExists('products');
    }
};