<?php

namespace Service\Module\ToDo\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Service\Module\ToDo\Service\TodoService;

class TodoController extends Controller
{
    /** @var TodoService $todoService */
    private TodoService $todoService;

    public function __construct() {
        View::addNamespace('todo', __DIR__ . '/../View');

        $this->todoService = app()->make(TodoService::class);
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'todo::index',
            ['todos' => $this->todoService->getTodos()]
        );
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $this->todoService->deleteTodo($id);
        return redirect()->route('todo.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = $request->get('user');
        $message = $request->get('message');

        if ($this->todoService->createNewTodo($user, $message)) {
            Session::flash('message', 'Das Todo wurde erstellt');
            Session::flash('alert-class', 'alert-info');
        } else {
            Session::flash('message', 'Das Todo wurde nicht erstellt.');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->route('todo.index');
    }
}
