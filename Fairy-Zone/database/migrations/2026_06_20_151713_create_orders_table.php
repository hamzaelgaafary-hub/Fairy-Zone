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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // INT AUTO_INCREMENT PRIMARY KEY
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('order_number', 50)->unique();
            $table->enum('status', ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->decimal('total_amount', 10, 2);
            // معرف عنوان الشحن (مسموح أن يكون فارغاً nullable) ومربوط بجدول العناوين
            $table->foreignId('shipping_address_id')->nullable()->constrained('user_addresses')->onDelete('set null');
            // ملاحظات إضافية (nullable)
            $table->text('notes')->nullable();
            $table->timestamps(); 
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products');
            // تخزين اسم المنتج وسعره والكمية والإجمالي لحظة الشراء لضمان ثبات البيانات الممالية والتقارير
            $table->string('product_name', 255);
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);

            // في هذا الجدول لا تحتاج لـ timestamps إلا إذا كنت تريد تتبع وقت إضافة صنف معين للطلب بدقة
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
};
