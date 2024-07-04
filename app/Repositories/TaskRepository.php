<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskRepository
{
    public static function getAll()
    {
        return Task::with([])->get();
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
