<?php

use App\Lib\Schema;

class Test3CreateUsersTable {

    public function up() : string {
        $builder = new Schema("user");

        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("username", "VARCHAR(45)", true);
        $builder->addColumn("email", "VARCHAR(45)", true, false, true);
        $builder->addColumn("password", "VARCHAR(255)", true);
        $builder->addColumn("role_id", "INT", true, false);

        $builder->setPrimaryKey("id");
        $builder->setForeignKey("role_id", "role", "id");
        $builder->setUniqueIndex("name_UNIQUE", "username");

        return $builder->build();
    }

}
