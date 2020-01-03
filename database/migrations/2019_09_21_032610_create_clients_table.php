<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'clients',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->char('document', 14);
                $table->decimal('fee', 5, 2)->default(0);
                $table->string('email');
                $table->char('phone', 11);
                $table->char('state_registration', 14)
                    ->nullable();
                $table->string('public_place');
                $table->string('number');
                $table->string('complement')
                    ->nullable();
                $table->string('neighborhood');
                $table->string('municipality');
                $table->char('municipality_code', 7);
                $table->char('uf', 2);
                $table->char('cep', 8);
                $table->unsignedBigInteger('saas_business_id');
                $table->foreign('saas_business_id')
                    ->references('id')
                    ->on('saas_businesses');

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
