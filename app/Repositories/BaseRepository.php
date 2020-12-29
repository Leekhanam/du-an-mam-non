<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    //table muốn tương tác
    protected $table;

    //Khởi tạo
    public function __construct()
    {
        $this->setTable();
    }

    //Lấy model tương tác
    abstract public function getTable();

    public function setTable()
    {
        $this->table = DB::table($this->getTable());
    }

    public function getAll()
    {
        $result = $this->table->get();
        return $result;
    }
    public function findById($id)
    {
        $result = $this->table->find($id);

        return $result;
    }
    public function create($attributes = [])
    {
        $result  = $this->table->insert($attributes);
        return $result;
    }

    public function update($id, $attributes = [])
    {
        return $this->table
            ->where('id', $id)
            ->update($attributes);
    }

    public function delete($id)
    {
        return $this->table->where('id', $id)->delete();
    }

    public function  deleteTemporary($id)
    {
        
    }
}
