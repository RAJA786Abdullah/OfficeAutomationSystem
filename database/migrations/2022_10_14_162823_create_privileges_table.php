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
		Schema::create('privilege', function (Blueprint $table) {
			$table->bigIncrements('privilegeID');
			$table->foreignId('moduleID')->constrained('modules','moduleID');
			$table->foreignId('accessLevelID')->constrained('accessLevel','accessLevelID');
			$table->string('privilegeCode');
			$table->string('privilegeName');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privilege');
    }
};
