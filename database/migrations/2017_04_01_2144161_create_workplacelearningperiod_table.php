<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkplacelearningperiodTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workplacelearningperiod', function (Blueprint $table): void {
            $table->integer('wplp_id', true);
            $table->integer('student_id')->index('fk_WorkplaceLearningPeriod_Student1_idx');
            $table->integer('wp_id')->index('fk_WorkplaceLearningPeriod_Workplace1_idx');
            $table->date('startdate');
            $table->date('enddate');
            $table->integer('nrofdays');
            $table->string('description', 500);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('workplacelearningperiod');
    }
}
