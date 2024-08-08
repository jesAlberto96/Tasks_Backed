<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Task;
use DataTables;

class TaskRepository
{
    const PERMISSION_DISPLAY_ALL = 'tasks.show-all';

    public static function getAllTable(Request $request)
    {
        $query = Task::query();

        if (!auth()->user()->hasAnyPermission([self::PERMISSION_DISPLAY_ALL])){
            $query->where('user_id', auth()->user()->id);
        }

        if ($request->has('search') && $request->search != '') {
            $query = $this->setFilters($query);
        }

        $data = $query->select(['id', 'title', 'description', 'completed', 'date_expired']);
        return DataTables::of($data)->make(true);
    }

    private function setFilters($query)
    {
        $count_filters = 0;
        $search = $request->search;

        foreach ($search as $key => $value) {
            if ($count_filters == 0){
                if (isset($value['conditions'])){
                    $operator = $value['operator'];
                    switch ($operator) {
                        case 'AND':
                            $query->where($key, 'like', "%{$value['conditions'][0]['filter']}%");
                            $query->where($key, 'like', "%{$value['conditions'][1]['filter']}%");
                            break;
                        case 'OR':
                            $query->where($key, 'like', "%{$value['conditions'][0]['filter']}%");
                            $query->orWhere($key, 'like', "%{$value['conditions'][1]['filter']}%");
                            break;
                    }
                } else {
                    $query->where($key, 'like', "%{$value['filter']}%");
                }
            } else {
                $query->orWhere($key, 'like', "%{$value['filter']}%");
            }
            $count_filters++;
        }

        return $query;
    }

    public static function getByID($id)
    {
        return Task::with([])->find($id);
    }

    public static function create($data)
    {
        return Task::create($data);
    }

    public static function update(Task $model, $data)
    {
        return $model->update($data);
    }

    public static function delete(Task $model)
    {
        return $model->delete();
    }
}
