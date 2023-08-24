<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPanelSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_panel_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('close_sidebar_by_default_on_big_screens')->default(0);
            $table->string('logo')->nullable();
            $table->string('mini_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->integer('logo_same_as_front_logo')->default(0);
            $table->integer('favicon_same_as_front_favicon')->default(0);
            $table->integer('show_enquiries')->default(1);
            $table->integer('show_traffic')->default(0);
            $table->integer('show_newsletter_users')->default(1);
            $table->integer('show_contacts')->default(1);
            $table->integer('testimonials')->default(1);
            $table->integer('receive_notifications')->default(1);
            $table->integer('receive_notifications_via_email')->default(1);
            $table->integer('show_secret_keys_page')->default(0);
            $table->integer('show_lock_account')->default(0);
            $table->integer('ask_password_before_changing_frontend_settings')->default(0);
            $table->integer('ask_password_before_changing_adminpanel_settings')->default(0);
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
        Schema::dropIfExists('admin_panel_settings');
    }
}
