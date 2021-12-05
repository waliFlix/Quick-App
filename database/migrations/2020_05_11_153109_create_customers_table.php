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
<<<<<<< HEAD
    
=======

>>>>>>> 4baa43826c1768d7c8f0d9b1df6863fc84a2b51f
    /**
    * Run the migrations.
    * @table customers
    *
    * @return void
    */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
<<<<<<< HEAD
            
            $table->increments('id');
            $table->string('name', 145);
            $table->string('phone', 30);
            $table->integer('bouns');
            $table->integer('type');
            $table->unsignedInteger('account_id');
            
            $table->index(["account_id"], 'customers_accounts1_idx');
            $table->timestamps();
            
            
            $table->foreign('account_id', 'customers_accounts1_idx')
            ->references('id')->on('accounts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

=======

            $table->increments('id');
            $table->string('name', 145);
            $table->string('phone', 30);
            $table->string('secendPhone',30)->nullable();
            $table->string('email',50);
            $table->timestamps();
>>>>>>> 4baa43826c1768d7c8f0d9b1df6863fc84a2b51f
        });
        Schema::enableForeignKeyConstraints();
        \DB::statement('ALTER TABLE customers AUTO_INCREMENT = 100;');
    }
<<<<<<< HEAD
    
=======

>>>>>>> 4baa43826c1768d7c8f0d9b1df6863fc84a2b51f
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 4baa43826c1768d7c8f0d9b1df6863fc84a2b51f
