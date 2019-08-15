<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\LogRepositoryInterface;
use App\Repositories\LogRepository;
use App\Models\Log;

class LogController extends Controller
{
    protected $logRepository;

    public function __construct(Log $log) {
        $this->logRepository = new LogRepository($log);
    }
    public function getAllLog () {
        $logs = $this->logRepository->findAll();

        return response()->json($logs, 200);
    }

    public function getLogById ($log_id) {
        $log = $this->logRepository->findById($log_id);

        return response()->json($log, 200);
    }

    public function createLog (Request $request) {
        $this->validate($request, [
            'action' => 'required|max:255|String',
            'detail' => 'required|max:255|String',
        ]);

        return $this->logRepository->store($request->user(), $request->only($this->logRepository->getModel()->fillable));
    }

    public function deleteLogById ($log_id) {
        $log_id = $this->logRepository->deleteById($log_id);

        return response()->json($log_id, 200);
    }
}
