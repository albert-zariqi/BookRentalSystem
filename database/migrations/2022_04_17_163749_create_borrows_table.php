<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reader_id');
            $table->unsignedBigInteger('book_id');
            $table->enum('status', ['PENDING', 'ACCEPTED', 'REJECTED', 'RETURNED']);
            $table->datetime('request_processed_at')->nullable();
            $table->unsignedBigInteger('request_managed_by')->nullable();
            $table->datetime('deadline')->nullable();
            $table->datetime('returned_at')->nullable();
            $table->unsignedBigInteger('return_managed_by')->nullable();
            $table->timestamps();

            $table->foreign('reader_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('request_managed_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('return_managed_by')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('books', function (Blueprint $table) {
            $table->string('authors', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrows');
    }
};
