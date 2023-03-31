<?php

use App\Lib\Schema;
use App\Model\Users;

class CreateUsersTable {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "user";
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    // Creates the table with specified configuration.
    public function up() : void {
        $builder = new Schema($this->table);

        // CREATE COLUMNS AND CONSTRAINTS HERE
        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("username", "VARCHAR(45)", true, false, true);
        $builder->addColumn("email", "VARCHAR(45)", true, false, true);
        $builder->addColumn("password", "VARCHAR(255)");
        $builder->addColumn("role_id", "INT", true);
        $builder->addColumn("provider_id", "INT", true);

        $builder->setPrimaryKey("id");
        $builder->setForeignKey("role_id", "role", "id");
        $builder->setForeignKey("provider_id", "provider", "id");

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
        $users = new Users($this->mysqli);

        $keys = ['username', 'email', 'password', 'role_id', 'provider_id'];

        $values = ['Administrator Hid', 'admin@gmail.com', '$2y$10$RgJa7ymXXCKq.9j0KuujWe4DmmYRTbx.ZR7jeCtJypwg3NdQqDu0e', 1, 1];
        $users->create($this->table, $keys, $values);

        $values1 = ['John Doe', 'john@gmail.com', '$2y$10$/QtjNDtOWVgbyU7Fks1fHOec4.2hOwQDjr2O.DS85czSehGtBa6/y', 2, 1];
        $users->create($this->table, $keys, $values1);

        $values1 = ['The Fast Foods', 'food@company.com', '$2y$10$Msc1hGsre/gAaAY371vwPuOrMd/FE4XRY2vL2vXgVsta8AkYxzCC6', 3, 1];
        $users->create($this->table, $keys, $values1);
    }

}
