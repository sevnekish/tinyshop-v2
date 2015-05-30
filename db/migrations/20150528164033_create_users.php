<?php

use Phinx\Migration\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method. This method define a reversible migration.
     */
    public function change()
    {
        /**
         * Phinx automatically creates an auto-incrementing
         * primary key column called id for every table.
         */
        $users = $this->table('users');
        $users->addColumn('name',              'string',   array('limit' => 255))
              ->addColumn('email',             'string',   array('limit' => 255))
              ->addColumn('telephone',         'string',   array('limit' => 255))
              ->addColumn('address',           'string',   array('limit' => 255))
              ->addColumn('admin',             'boolean',  array('default' => false))
              ->addColumn('password_digest',   'string',   array('limit' => 255))
              ->addColumn('remember_digest',   'string',   array('limit' => 255))
              ->addColumn('activation_digest', 'string',   array('limit' => 255))
              ->addColumn('activated',         'boolean',  array('default' => false))
              ->addColumn('activated_at',      'datetime', array('null' => true))
              ->addColumn('reset_digest',      'string',   array('limit' => 255))
              ->addColumn('reset_sent_at',     'datetime', array('null' => true))
              ->addColumn('created_at',        'datetime')
              ->addColumn('updated_at',        'datetime', array('null' => true))
              ->addIndex(array('email'), array('unique' => true))
              ->create();
    }

    /**
     * When a change method exists Phinx will automatically
     * ignore the up and down methods
     */

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