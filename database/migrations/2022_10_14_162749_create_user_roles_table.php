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
		Schema::create('userRole', function (Blueprint $table) {
			$table->foreignId('userID')->constrained('users','userID');
			$table->foreignId('roleID')->constrained('roles','roleID');
			$table->primary(['roleID','userID']);
			$table->timestamp('dateCreated')->useCurrent();
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userRole');
    }
};
