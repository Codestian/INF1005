<?php

use App\Lib\Schema;

class CreateUsersTable {

    public function up() : string {
        $builder = new Schema("users");
        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("username", "VARCHAR(64)", true);
        $builder->addColumn("email", "VARCHAR(255)", true);
        $builder->addColumn("password", "VARCHAR(60)", true);

        $builder->setPrimaryKey("id");
        $builder->setUniqueIndex("name_UNIQUE", "username");

        return $builder->build();
    }

}
