<?php

use Phinx\Migration\AbstractMigration;

class CreatePhotos extends AbstractMigration
{
    /**
     * Change Method.
     */
    public function change()
    {
        $users = $this->table('photos');
        $users->addColumn('item_id',    'integer',  array('limit' => 11))
              ->addColumn('photo',      'text')
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