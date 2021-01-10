<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

trait Pager
{
    public function tableName()
    {
        return '';
    }

    public function query()
    {
        $tablename = $this->tableName();
        return DB::table($tablename)->orderBy($tablename . '.id', 'desc');
    }

    public function Paginate($query)
    {
        return $query->paginate(10);
    }

    public function Pagination(Request $request)
    {
        $query = $this->query();
        if ($request->searchField && $request->searchTerm) {
            $query->where($request->searchField, 'like', "%{$request->searchTerm}%");
        }
        return $this->Paginate($query);
    }
}
