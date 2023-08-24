<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontendSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_big_text')->nullable();
            $table->string('hero_small_text_upper')->nullable();
            $table->string('hero_small_text_bottom')->nullable();
            $table->integer('show_enquiry_form')->default(1);
            $table->integer('show_count_section')->default(1);
            $table->integer('show_testimonials')->default(1);
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->integer('show_about_on_nav')->default(1);
            $table->integer('show_services_on_nav')->default(1);
            $table->integer('show_countries_on_nav')->default(1);
            $table->integer('show_contact_on_nav')->default(1);
            $table->integer('show_careers_on_nav')->default(1);
            $table->integer('show_newsletter_on_footer')->default(1);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('address')->nullable();
            $table->integer('show_coursefinder_on_nav')->default(1);
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
        Schema::dropIfExists('frontend_settings');
    }
}
