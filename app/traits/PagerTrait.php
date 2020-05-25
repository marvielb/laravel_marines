<?php

use Illuminate\Support\Facades\DB;

trait Pager
{
    public function tableName() {
        return '';
    }

    public function Pagination()
    {
        $tablename = $this->tableName();
        return DB::table($tablename)->orderBy('id','desc')->paginate(10);
    }
}
