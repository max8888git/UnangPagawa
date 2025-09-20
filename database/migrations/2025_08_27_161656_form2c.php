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
        Schema::create('tbl_form2c', function (Blueprint $table) {
            $table->string('form2CID')->primary();
            $table->string('protocol_title');
            $table->string('pi_name');
            $table->string('coiname');
            $table->string('pi_contact');
            $table->string('pi_email');
            $table->string('institution');
            $table->string('institute_address');
            $table->string('erb_contact');

            //Part II
            
            //Part III Research Study
            $table->text('research_purpose')->nullable();
            $table->text('research_procedures')->nullable();
            $table->text('participant_selection')->nullable();
            $table->text('participation_study')->nullable();
            $table->text('duration')->nullable();
            $table->text('potential_risks')->nullable();
            $table->text('potential_benefits')->nullable();
            $table->text('management_study_injuries')->nullable();
            $table->text('compensation')->nullable();
            $table->text('confidentiality')->nullable();
            $table->text('voluntary_participation')->nullable();
            $table->text('title_name');
            $table->text('institution');
            $table->text('pi_contact');
            $table->text('pi_email');
            $table->text('approval_mcuerb')->nullable();
            $table->text('contact_mcuerb')->nullable();

            //Part IV Certificate of Consent 
            $table->boolean('information_sheet')->default(false);
            $table->boolean('study_discuss')->default(false);
            $table->boolean('satisfactory_answers')->default(false);
            $table->boolean('study_information')->default(false);
            $table->boolean('study_nature')->default(false);
            $table->boolean('withdraw')->default(false);
            $table->boolean('medical')->default(false);
            $table->boolean('interview')->default(false);
            $table->boolean('decision')->default(false);
            $table->boolean('voluntary')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_form2c');
    }
};
