<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;
use LaravelDoctrine\Migrations\Schema\Table;
use LaravelDoctrine\Migrations\Schema\Builder;

class Version20170316220552 extends AbstractMigration
{

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        (new Builder($schema))->create('Jobs',
                                       function (Table $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('contact_email');
            $table->text('description');
            $table->unsignedInteger('location_id');
            $table->foreign('Locations', 'location_id');
            $table->unsignedInteger('brand_id');
            $table->foreign('Brands', 'brand_id');
            $table->timestamp('created_on');
        });
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        (new Builder($schema))->drop('Jobs');
    }

}
