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

    public function store($user, $data, $lipstickColor) {
        $log = new Log();
        $log->action = $data['action'];
        if($data['action'] == "view") {
            $log->detail = 1;
        } else if($data['action'] == "like") {
            $log->detail = 3;
        } else if($data['action'] == "try") {
            $log->detail = 4;
        } else if($data['action'] == "store") {
            $log->detail = 5;
        } else {
            $log->detail = 0;
        }
        $log->user_id = $user->id;
        $lipstickColor->logs()->save($log);

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
