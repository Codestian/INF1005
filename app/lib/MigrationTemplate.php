<?php

use App\Lib\Schema;

class MigrationTemplate {

    public function up() : string {
        // Ensure table name is not plural.
        $builder = new Schema("");

        //  INSERT COLUMNS TO MAKE HERE

        return $builder->build();
    }

}
