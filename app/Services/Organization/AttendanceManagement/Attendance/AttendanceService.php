<?php

namespace App\Services\Organization\AttendanceManagement\Attendance;

use App\Http\Resources\Organization\AttendanceManagement\Attendance\AttendanceResource;
use App\Models\Organization\AttendanceManagement\Attendance\Attendance;
use App\Repositories\Organization\AttendanceManagement\Attendance\AttendanceRepository;
use App\Services\Service;

class AttendanceService extends Service
{
    protected $beginningOfTheDay;

    public function __construct(AttendanceRepository $attendanceRepository)
    {
        parent::__construct();
        $this->repository = $attendanceRepository;
        $this->beginningOfTheDay = strtotime(date('Y-m-d 00:00:00'));
    }

    protected function employee()
    {
        return auth()->user()->employee;
    }

    public function in()
    {   
        $inData = Attendance::where([
            ['employee_id', $this->employee()->id],
            ['in', '>=', $this->beginningOfTheDay],
            ['out', null],
        ])
        ->orderBy('in', 'DESC')
        ->first();

        if($inData){
            $this->setResponce(0,'Emloyee is already at work', new AttendanceResource($inData), 501);     
        }

        if($this->responce['status'] == 1){
            $attendance = Attendance::create([
                'employee_id' => $this->employee()->id,
                'in' => time(),
            ]);
            $this->setResponce(null, null, new AttendanceResource($attendance));
        }

        return $this->return();
    }

    public function out()
    {
        $attendance = Attendance::where([
            ['employee_id', $this->employee()->id],
            ['in', '>=', $this->beginningOfTheDay],
            ['out', null],
        ])
        ->orderBy('in', 'DESC')
        ->first();

        if($attendance){
            $attendance->out = time();
            $attendance->duration = time() - $attendance->in;
            $attendance->save();
            $this->setResponce(null,null,  new AttendanceResource($attendance));
        }else{
            $this->setResponce(0,'Employee "in" data not found for today.', null, 404);
        }

        return $this->return();
    }

    public function status()
    {
        $attQuery = Attendance::where([
            ['employee_id', $this->employee()->id],
            ['in', '>=', $this->beginningOfTheDay],
        ])
        ->orderBy('in', 'DESC');

        $attendance = $attQuery->first();

        if($attendance && empty($attendance->out)){
            $attStatus = 'IN';
        }else{
            $attStatus = 'OUT';
        }

        $inouts = Attendance::where([
            ['employee_id', $this->employee()->id],
            ['in', '>=', $this->beginningOfTheDay],
        ])
        ->orderBy('in', 'DESC')
        ->get();

        $data = [
            'status' => $attStatus,
            'last_action' =>  $attendance ? new AttendanceResource($attendance) : null,
            'today_actions' => $attendance ? AttendanceResource::collection($inouts) : null
        ];

        $this->setResponce(null,null, $data);

        return $this->return();
    }
}
