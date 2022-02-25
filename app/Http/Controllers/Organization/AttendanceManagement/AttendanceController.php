<?php

namespace App\Http\Controllers\Organization\AttendanceManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\AttendanceManagement\Attendance\AttendanceStoreUpdateRequest;
use App\Services\Organization\AttendanceManagement\Attendance\AttendanceService;

class AttendanceController extends Controller
{

    protected AttendanceService $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function in()
    {
        $this->serviceResult  = $this->attendanceService->in();
        return $this->responce();
    }

    public function out()
    {
        $this->serviceResult  = $this->attendanceService->out();
        return $this->responce();
    }

    public function status()
    {
        $this->serviceResult  = $this->attendanceService->status();
        return $this->responce();
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->attendanceService->getPaginate($indexRequest->validated());
    }

    public function store(AttendanceStoreUpdateRequest $attendanceStoreUpdateRequest)
    {
        return $this->attendanceService->store($attendanceStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->attendanceService->show($id);
    }


    public function update($id,  AttendanceStoreUpdateRequest $attendanceStoreUpdateRequest)
    {
        return $this->attendanceService->edit($id, $attendanceStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->attendanceService->delete($id);
    }
}
