<?php

namespace Service\Module\ToDo\Service;

use Illuminate\Support\Str;
use Service\Module\ToDo\Gateway\TodoGateway;

class TodoService
{
    /** @var TodoGateway $gateway */
    private TodoGateway $gateway;

    public function __construct()
    {
        $this->gateway = new TodoGateway();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getTodos()
    {
        return $this->gateway->getTodos();
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteTodo(int $id): int
    {
        return $this->gateway->deleteTodo($id);
    }

    /**
     * @param string $user
     * @param string|null $message
     * @return bool
     */
    public function createNewTodo(string $user, ?string $message): bool
    {
        $messageLength = Str::length($message);
        if ($messageLength < 1 || $messageLength > 255) {
            return false;
        }
        return $this->gateway->createNewTodo($user, $message);
    }
}
