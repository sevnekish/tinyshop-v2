<?php

use Phinx\Migration\AbstractMigration;

class CreateBrands extends AbstractMigration
{
    /**
     * Change Method.
     */
    public function change()
    {
        $brands = $this->table('brands');
        $brands->addColumn('name',       'string',  array('limit' => 255))
               ->addColumn('created_at', 'datetime')
               ->addColumn('updated_at', 'datetime', array('null' => true))
               ->create();
    }

    
    /**
     * Migrate Up.
     */
    public function up()
    {
    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}