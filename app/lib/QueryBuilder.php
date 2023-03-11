<?php namespace App\Lib;

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

    public function __toString(): string
    {
        $where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
        return 'SELECT ' . implode(', ', $this->fields)
            . ' FROM ' . implode(', ', $this->from)
            . $where;
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
}