<?php

use Phinx\Migration\AbstractMigration;

class CreateImagesTable extends AbstractMigration {
    public function up()
    {
        // create the table
        $table = $this->table('images');
        $table
            ->addColumn('name', 'text')
            ->addColumn('gallery_id', 'integer')
            ->create();


    }
    public function down() {
        if ($this->hasTable('images'))
            $this->dropTable('images');
    }
}
