<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('name', 'string', [
            'default' => '',
            'limit' => '50',
            'null' => false
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('updated', 'datetime', [
            'default' => null,
            'null' => false
        ]);
        $table->create();
    }
}
