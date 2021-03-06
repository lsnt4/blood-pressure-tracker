<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDeleteCascade()->onUpdateCascade();
            $table->decimal('systole', 5, 2);
            $table->decimal('diastole', 5, 2);
            $table->decimal('pulse', 5, 2);
            $table->boolean('is_irregular_hb')->nullable();
            $table->decimal('pulse_pressure', 5, 2)->nullable();
            $table->decimal('mean_arterial_pressure', 5, 2)->nullable();
            $table->string('location', 32)->nullable();
            $table->string('posture', 32)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
