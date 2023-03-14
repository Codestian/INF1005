<?php
// Hakimator is a small program (only used in development) to create columns and tables in MySQL.
// Migrations are a way to create tables into MySQL database, without writing any SQL statements.
// This allows for easier maintenance. Basically Laravel's artisan migrations command built from scratch.

// To migrate all tables, run `php hakimator.php migrate`
// To create a new migration, run `php hakimator.php make:migration create_myTable_table`

use App\Lib\Database;

$function = $argv[1];
$params = array_slice($argv, 2);

function migrate() {
    require_once 'app/lib/Database.php';

    $mysqli = (new Database())->getConnection();

    foreach (get_arr_of_migrations() as $migration) {
        $query = $migration->up();
        try {
            $mysqli->query($query);
            echo "Successfully migrated to database!\n";
        }
        catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}

function get_arr_of_migrations() : array {
    $arr = [];

    $files = glob('database/migrations/*.php');
    foreach ($files as $file) {
        require_once $file;
        $class_name = pathinfo($file, PATHINFO_FILENAME);
        $class_name = str_replace('_', ' ', $class_name);
        $class_name = ucwords($class_name);
        $class_name = str_replace(' ', '', $class_name);

        require_once 'app/lib/Schema.php';
        $class = new $class_name();

        $arr[] = $class;
    }

    return $arr;
}

function runFunc2($param1, $param2) {
    // Code to be executed for func2
    echo "Running func2 with param1=$param1 and param2=$param2\n";
}

function create_migration($input_name) {
    $class_name = $input_name;
    $class_name = str_replace('_', ' ', $class_name);
    $class_name = ucwords($class_name);
    $class_name = str_replace(' ', '', $class_name);


    // Read the contents of the source file
    $source_contents = file_get_contents('app/lib/MigrationTemplate.php');

    // Replace the class name with the new class name
    $new_contents = str_replace('MigrationTemplate', $class_name, $source_contents);

    // Write the new contents to the new file
    file_put_contents( "database/migrations/{$input_name}.php", $new_contents);

    echo "Migration successfully created!\n";
}

// Execute the appropriate function based on command-line arguments
switch ($function) {
    case "make:migration":
        if(isset($params[0])) {
            create_migration($params[0]);
        }
        else {
            echo "Missing parameter\n";
        }
        break;
    case "migrate":
        migrate();
        break;
    default:
        echo "Invalid function name";
        break;
}
