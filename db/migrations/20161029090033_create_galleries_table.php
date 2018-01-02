<?php

use Phinx\Migration\AbstractMigration;

class CreateGalleriesTable extends AbstractMigration {
    public function up() {
        // create the table
        $table = $this->table('galleries');
        $table
            ->addColumn('title', 'text')
            ->addColumn('url', 'text')
            ->create();


    }
    public function down() {
        if ($this->hasTable('galleries'))
            $this->dropTable('galleries');
    }
}
