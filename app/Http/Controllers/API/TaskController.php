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
        try {
            return TaskRepository::getAllTable($request);
        } catch (Exception $ex) {
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }

    public function show(Task $task)
    {
        try {
            return Response::sendResponse($task ?? []);
        } catch (Exception $ex) {
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            return Response::sendResponse(TaskRepository::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'date_expired' => $request->input('date_expired'),
                'user_id' => auth()->user()->id,
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
        try {
            return Response::sendResponse(TaskRepository::delete($task), "Registro eliminado");
        } catch (Exception $ex) {
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }
}
