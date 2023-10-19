<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingValue', function (Blueprint $table) {
			$table->bigIncrements('settingValueID');
			$table->unsignedBigInteger('settingID');
			$table->unsignedBigInteger('settingTypeID');
			$table->unsignedBigInteger('foreignID'); // userID or clientID
			$table->text('settingValue')->nullable();
			$table->timestamp('dateCreated')->useCurrent();
            $table->foreignId('createdByUserID')->constrained('users','userID');
			$table->foreign('settingID')->references('settingID')->on('setting');
			$table->foreign('settingTypeID')->references('settingTypeID')->on('settingType');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settingValue');
    }
}
