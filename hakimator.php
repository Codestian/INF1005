<?php
// Hakimator is a small script (only used in development) to create columns and tables in MySQL.
// Migrations are a way to create tables into MySQL database, without writing any SQL statements.
// This allows for easier development and setting up.
// This is basically Laravel's artisan migrations command built from scratch.

// To clear all tables in a schema, run `php hakimator.php clear $schema` where $schema is your database name.
// To create a new migration, run `php hakimator.php make:migration create_myTable_table`. Edit the file accordingly.
// To migrate all tables, run `php hakimator.php migrate`.
// To insert prebuilt data to all tables, run `php hakimator.php seed`.

use App\Lib\Database;
use App\Lib\Schema;

//  For PHP scripts, we need to require the necessary php files.
//  It is noted that this file is not meant to be used in production, rather it is meant to aid in development.
require_once 'app/lib/Database.php';
require_once 'app/lib/Model.php';
require_once 'app/lib/QueryBuilder.php';
require_once 'app/lib/Schema.php';
require_once 'app/lib/interfaces/CrudInterface.php';
$files = glob('app/model/*.php');
foreach ($files as $file) {
    require_once($file);
}

$function = $argv[1];
$params = array_slice($argv, 2);

$mysqli = (new Database())->getConnection();

function migrate() : void {
    foreach (get_arr_of_migrations() as $migration) {
        try {
            //  Attempt to run SQL statement to create table.
            $migration->up();
            echo "Successfully migrated to database!\n";
        }
        catch (\mysqli_sql_exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
}

function seed() : void {
    foreach (get_arr_of_migrations() as $migration) {
        try {
            //  Attempt to run SQL statement to create content for table
            $migration->seed();
            echo "Successfully seeded to database!\n";
        }
        catch (\mysqli_sql_exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
}

function resetSchema(string $schema) {
    global $mysqli;
    $mysqli->multi_query(Schema::resetSchema($schema));
    echo "Successfully cleaned the database!\n";
}

function get_arr_of_migrations() : array {
    $arr = [];
    global $mysqli;

    $files = glob('database/migrations/*.php');
    foreach ($files as $file) {
        require_once $file;
        $class_name = pathinfo($file, PATHINFO_FILENAME);

        $file_parts = explode('_', $class_name);
        $class_name_parts = array_slice($file_parts, 4);
        $class_name = implode(' ', $class_name_parts);
        $class_name = ucwords($class_name);
        $class_name = str_replace(' ', '', $class_name);

        require_once 'app/lib/Schema.php';
        $class = new $class_name($mysqli);

        $arr[] = $class;
    }

    return $arr;
}

function create_migration($input_name) : void {
    $class_name = $input_name;
    $class_name = str_replace('_', ' ', $class_name);
    $class_name = ucwords($class_name);
    $class_name = str_replace(' ', '', $class_name);

    // Read the contents of the source file
    $source_contents = file_get_contents('app/lib/MigrationTemplate.php');

    // Replace the class name with the new class name
    $new_contents = str_replace('MigrationTemplate', $class_name, $source_contents);

    // Get current timestamp
    $date = new DateTime();
    $time = $date->format('Y_m_d_His');

    // Write the new contents to the new file
    file_put_contents( "database/migrations/{$time}_{$input_name}.php", $new_contents);

    echo "Migration successfully created!\n";
}

// Function that outputs the SQL statement created using QueryBuilder.
// Useful for debugging and knowing what's to be executed in MySQL>
function echoSQL() : void {
    // Edit your SQL statement between the lines.
    $builder = new Schema("exampleTable");
//    ----------------------------------------------

    $builder->addColumn("id", "INT", true, true);
    $builder->addColumn("username", "VARCHAR(45)", true, false, true);
    $builder->setPrimaryKey("id");

//    ----------------------------------------------
    echo $builder->buildCreate() . "\n";
}

// Execute the appropriate function based on command-line arguments
switch ($function) {
    case "make:migration":
        if(isset($params[0])) {
            create_migration($params[0]);
        }
        else {
            echo "Hakimator says: Missing parameter\n";
        }
        break;
    case "clear":
        if(isset($params[0])) {
            resetSchema($params[0]);
        }
        else {
            echo "Hakimator says: Missing parameter\n";
        }
        break;
    case "migrate":
        migrate();
        break;
    case "seed":
        seed();
        break;
    case "test":
        echoSQL();
        break;
    default:
        echo "Hakimator says: Invalid function name\n";
        break;
}
