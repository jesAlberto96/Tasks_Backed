<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use App\Http\Controllers\ResponseController as Response;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use DataTables;

class TaskController extends Controller
{
    public function getAll(Request $request)
    {
        $query = Task::query();

        if ($request->has('search') && $request->search != '') {
            $query = $this->setFilters($query);
        }

        $data = Task::select(['id', 'title', 'description', 'completed', 'date_expired']);
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

    public function show(Task $task)
    {
        return Response::sendResponse($task ?? []);
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            return Response::sendResponse(TaskRepository::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'date_expired' => $request->input('date_expired'),
                'user_id' => 1,
            ]));
        } catch (Exception $ex) {
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            TaskRepository::update($task, $request->input());

            return Response::sendResponse($task);
        } catch (Exception $ex) {
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }

    public function destroy(Task $task)
    {
        return Response::sendResponse(TaskRepository::delete($task), "Registro eliminado con exito");
    }
}
