<?php
use Migrations\AbstractMigration;

class RenameAndAddUsersColumn extends AbstractMigration
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
        $table->renameColumn('password', 'password_digest');
        $table->addColumn('activation_digest', 'string', [
            'default' => null,
            'null' => false,
        ]);
    }
}
