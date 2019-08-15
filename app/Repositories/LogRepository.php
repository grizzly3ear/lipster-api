<?php

namespace App\Repositories;

use App\Models\Log;

class LogRepository implements LogRepositoryInterface
{
    protected $log;

    public function __construct(Log $log){
        $this->log = $log;
    }

    public function findAll() {
        return Log::all();
    }

    public function findById($log_id) {
        return Log::findOrFail($log_id);
    }

    public function store($user, $data) {
        $log = new Log();
        $log->action = $data['action'];
        $log->detail = $data['detail'];
        $log->user_id = $user->id;

        $log->save();

        return $log;
    }

    public function getModel()
    {
        return $this->log;
    }

    public function deleteById($log_id) {
        $log = Log::findOrFail($log_id);

        $log->delete();

        return $log->id;
    }
}
