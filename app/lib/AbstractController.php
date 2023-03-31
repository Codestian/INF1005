<?php namespace App\Lib;
use App\Lib\Interfaces\ControllerInterface;
use mysqli;
use stdClass;

abstract class AbstractController implements ControllerInterface
{

    protected Model $model;
    protected string $table;
    protected array $columns;
    public function __construct(Model $model, string $table, array $columns)
    {
        $this->model = $model;
        $this->table = $table;
        $this->columns = $columns;
    }

    public function getAllRows(Request $req, Response $res): void
    {
        $data = $this->model->read($this->columns, $this->table, ['1 = 1']);
        if(!empty($data)) {
            $data[0]->tables = new StdClass();
            foreach ($data[0] as $key => $value) {
                if (str_ends_with($key, '_id')) {
                    // This property represents a foreign key column, so output its value
                    $table_name = substr($key, 0, -3);
                    $data_1 = $this->model->read(['*'], $table_name, ['id = ' . $value]);

                    $data[0]->tables->$table_name = $data_1;
                }
            }
            $this->model->close();
            $res->toJSON($data);
        }
        else {
            $data1 = new StdClass();
            $data1->message = "Cannot find row associated with id";
            $res->toJSON($data1, 400);
        }
    }

    public function getOneRowById(Request $req, Response $res): void
    {
        $data = $this->model->read($this->columns, $this->table, ['id = ' . $req->params[0]]);
        if(!empty($data)) {
            $data[0]->tables = new StdClass();
            foreach ($data[0] as $key => $value) {
                if (str_ends_with($key, '_id')) {
                    // This property represents a foreign key column, so output its value
                    $table_name = substr($key, 0, -3);
                    $data_1 = $this->model->read(['*'], $table_name, ['id = ' . $value]);

                    $data[0]->tables->$table_name = $data_1;
                    }
            }
            $this->model->close();
            $res->toJSON($data);
        }
        else {
            $data1 = new StdClass();
            $data1->message = "Cannot find row associated with id";
            $res->toJSON($data1, 400);
        }
    }

    public function createRow(Request $req, Response $res): void
    {
        $columns_no_id = array_slice($this->columns, 1);
        $data = $this->model->create($this->table, $columns_no_id, $req->getJSON($columns_no_id));
        $this->model->close();
        $res->toJSON($data);
    }

    public function updateRow(Request $req, Response $res): void
    {
        $columns_no_id = array_slice($this->columns, 1);
        $merged = array_map(fn($key, $val) => "$key = '$val'", $columns_no_id, $req->getJSON($columns_no_id));
        $res->toJSON($this->model->update($this->table, $merged, ['id = ' . $req->params[0]]));
        $this->model->close();
    }

    public function deleteRow(Request $req, Response $res): void
    {
        $data = $this->model->delete($this->table, ['id = ' . $req->params[0]]);
        $this->model->close();
        $res->toJSON($data);
    }
}