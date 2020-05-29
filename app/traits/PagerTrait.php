<?php

use Illuminate\Support\Facades\DB;

trait Pager
{
    public function tableName() {
        return '';
    }

    public function query()
    {
        $tablename = $this->tableName();
        return DB::table($tablename)->orderBy($tablename.'.id','desc');
    }

    public function Paginate($query) {
        return $query->paginate(10);
    }

    public function Pagination()
    {
        return $this->Paginate($this->query());
    }


}
