<?php

use App\Lib\Schema;

class CreateBookingsTable {

    public function up() : string {
        $builder = new Schema("booking");

        //  INSERT COLUMNS TO MAKE HERE
        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("name", "VARCHAR(64)", true);

        $builder->setPrimaryKey("id");

        return $builder->build();
    }

}
