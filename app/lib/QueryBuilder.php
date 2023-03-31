<?php

namespace App\Lib;

// There is where the SQL statements for querying are created.
// Instead of manually creating SQl statement strings, we abstracted them to a chain pattern.
// Usage is in Model.php.
class QueryBuilder
{
    /**
     * @var array<string>
     */
    private array $fields = [];

    /**
     * @var array<string>
     */
    private array $conditions = [];

    /**
     * @var array<string>
     */
    private array $from = [];

    /**
     * @var string|null
     */
    private ?string $table = null;

    /**
     * @var array<string>
     */
    private array $set = [];

    /**
     * @var array<string>
     */
    private array $columns = [];

    /**
     * @var array<string>
     */
    private array $values = [];

    public function __toString(): string
    {
        $where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
        $fields = empty($this->fields) ? '*' : implode(', ', $this->fields);

        return match (true) {
            !empty($this->values) => 'INSERT INTO ' . $this->table . ' (' . $fields . ') VALUES (' . implode(', ', $this->values) . ')',
            !empty($this->set) => 'UPDATE ' . $this->table . ' SET ' . implode(', ', $this->set) . $where,
            !empty($this->table) => 'DELETE FROM ' . $this->table . $where,
            default => 'SELECT ' . $fields . ' FROM ' . implode(', ', $this->from) . $where,
        };
    }

    public function select(string ...$select): self
    {
        $this->fields = $select;
        return $this;
    }

    public function where(string ...$where): self
    {
        foreach ($where as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }

    public function from(string $table, ?string $alias = null): self
    {
        if ($alias === null) {
            $this->from[] = $table;
        } else {
            $this->from[] = "{$table} AS {$alias}";
        }
        return $this;
    }

    public function insert(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function columns(string ...$columns): self
    {
        $this->fields = $columns;
        return $this;
    }

    public function values(string ...$values): self
    {
        foreach ($values as $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            }
            $this->values[] = $value;
        }
        return $this;
    }

    public function update(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function set(string ...$set): self
    {
        foreach ($set as $arg) {
            $this->set[] = $arg;
        }
        return $this;
    }

    public function delete(string $table): self
    {
        $this->table = $table;
        return $this;
    }
}
