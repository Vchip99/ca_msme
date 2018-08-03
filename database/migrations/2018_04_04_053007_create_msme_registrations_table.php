<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsmeRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msme_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('adhaar_number');
            $table->string('adhaar_name');
            $table->string('application_category');
            $table->string('gender');
            $table->string('disability');
            $table->string('enterprise_name');
            $table->string('organisation_type');
            $table->string('pan_no');
            $table->string('building_no');
            $table->string('floor_no');
            $table->string('building_name');
            $table->string('street');
            $table->string('city');
            $table->string('pin');
            $table->string('state');
            $table->string('district');
            $table->string('is_same_address');
            $table->string('office_building_no')->nullable();
            $table->string('office_floor_no')->nullable();
            $table->string('office_building_name')->nullable();
            $table->string('office_street')->nullable();
            $table->string('office_city')->nullable();
            $table->string('office_pin')->nullable();
            $table->string('office_state')->nullable();
            $table->string('office_district')->nullable();
            $table->string('mob_no');
            $table->string('email');
            $table->string('business_start_date');
            $table->string('account_no');
            $table->string('ifsc');
            $table->string('business_activity');
            $table->string('nic2_digit_code');
            $table->text('actvity_description')->nullable();
            $table->string('employees');
            $table->string('investment_amount');
            $table->string('adhar_card')->nullable();
            $table->string('application_status');
            $table->string('payment_status')->nullable();
            $table->string('user_id')->default(' ');
            $table->string('assigned_sub_admin')->nullable();
            $table->string('sub_admin')->nullable();
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
        Schema::dropIfExists('msme_registrations');
    }
}
