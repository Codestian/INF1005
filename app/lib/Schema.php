<?php namespace App\Lib;

// There is where the SQL statements for creating tables are created.
// Instead of manually creating SQl statement strings, we abstracted them to a chain pattern.
// Usage is in MigrationTemplate.php, and to execute using hakimator.php.
class Schema {
    private $tableName;
    private $columns = array();
    private $primaryKey;
    private $uniqueIndex;

    public function __construct($tableName) {
        $this->tableName = $tableName;
    }

    public function addColumn($name, $type, $notNull = false, $autoIncrement = false) {
        $column = "`$name` $type";
        if ($notNull) {
            $column .= " NOT NULL";
        }
        if ($autoIncrement) {
            $column .= " AUTO_INCREMENT";
        }
        $this->columns[] = $column;
    }

    public function setPrimaryKey($name) {
        $this->primaryKey = $name;
    }

    public function setUniqueIndex($name, $column) {
        $this->uniqueIndex = array($name, $column);
    }

    public function build() {
        $sql = "CREATE TABLE `$this->tableName` (\n";
        $sql .= implode(",\n", $this->columns);
        if ($this->primaryKey) {
            $sql .= ",\nPRIMARY KEY (`$this->primaryKey`)";
        }
        if ($this->uniqueIndex) {
            $sql .= ",\nUNIQUE INDEX `{$this->uniqueIndex[0]}` (`{$this->uniqueIndex[1]}`)";
        }
        $sql .= "\n);";
        return $sql;
    }
}
