<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
    * Schema table name to migrate
    * @var string
    */
    public $tableName = 'customers';
    /**
    * Run the migrations.
    * @table customers
    *
    * @return void
    */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 145);
            $table->string('phone', 30);
            $table->string('secendPhone',30)->nullable();
            $table->string('email',50);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
        \DB::statement('ALTER TABLE customers AUTO_INCREMENT = 100;');
    }
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
