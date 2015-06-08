<?php

use Phinx\Migration\AbstractMigration;

class CreateCategories extends AbstractMigration
{
    /**
     * Change Method.
     */
    public function change()
    {
        $categories = $this->table('categories');
        $categories->addColumn('name',       'string',  array('limit' => 255))
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