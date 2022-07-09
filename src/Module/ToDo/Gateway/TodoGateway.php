<?php

namespace Service\Module\ToDo\Gateway;

use Illuminate\Support\Facades\DB;

class TodoGateway
{
    const TABLE_NAME = 'todos';

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getTodos()
    {
        return DB::table(self::TABLE_NAME)->orderBy('created_at', 'desc')->get();
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteTodo(int $id): int
    {
        return DB::table(self::TABLE_NAME)->delete($id);
    }

    /**
     * @param string $user
     * @param string $message
     * @return bool
     */
    public function createNewTodo(string $user, string $message): bool
    {
        return DB::table(self::TABLE_NAME)->insert(
            [
                'name' => $user,
                'message' => $message,
                'created_at' => now()
            ]
        );
    }
}
