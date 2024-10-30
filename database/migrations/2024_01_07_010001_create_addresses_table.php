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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            //البريد الالكتروني : الاردن
            $table->string('email_jo')->nullable();
            //رقم الهاتف : الاردن
            $table->string('phone_jo')->nullable();
            //موقع الشركة باللغة العربية : الاردن
            $table->string('address_jo')->nullable();
            //موقع الشركة باللغة الانجليزية : الاردن
            $table->string('address_en_jo')->nullable();
            //البريد الالكتروني : فلسطين
            $table->string('email_ps')->nullable();
            //رقم الهاتف : فلسطين
            $table->string('phone_ps')->nullable();
            //موقع الشركة باللغة العربية : فلسطين
            $table->string('address_ps')->nullable();
            //موقع الشركة باللغة الانجليزية : فلسطين
            $table->string('address_en_ps')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
