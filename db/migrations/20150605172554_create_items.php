<?php

use Phinx\Migration\AbstractMigration;

class CreateItems extends AbstractMigration
{
    /**
     * Change Method.
     */

    public function change()
    {
        $users = $this->table('items');
        $users->addColumn('category_id',     'integer',  array('limit' => 11))
              ->addColumn('brand_id',        'integer',  array('limit' => 11))
              ->addColumn('model',           'string',   array('limit' => 255))
              ->addColumn('characteristics', 'text')
              ->addColumn('description',     'text')
              ->addColumn('price',           'float')
              ->addColumn('instock',         'integer',  array('limit' => 11))
              ->addColumn('created_at',      'datetime')
              ->addColumn('updated_at',      'datetime', array('null' => true))
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