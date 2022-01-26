<?php

namespace App\Services;

use App\Actions\CreateLog;
use App\Actions\CreateUserProgram;
use App\Actions\RemoveUserProgram;
use App\Actions\SendMailNotification;
use App\Actions\UpdateUserProgram;
use App\Client;
use App\Exceptions\UserProgramIsAlreadyLinkedException;
use App\Mail\NewApplicantNotification;
use App\Payment;
use App\UserProgram;

class UserProgramService 
{
    private $createUserProgram;
    private $createLog;
    private $sendMailNotification;
    private $removeUserProgram;
    private $updateUserProgram;

    public function __construct(
        CreateUserProgram $createUserProgram,
        CreateLog $createLog,
        UpdateUserProgram $updateUserProgram, 
        RemoveUserProgram $removeUserProgram,
        SendMailNotification $sendMailNotification
    )
    {
        $this->createUserProgram = $createUserProgram;
        $this->createLog = $createLog;
        $this->sendMailNotification = $sendMailNotification;
        $this->removeUserProgram = $removeUserProgram;
        $this->updateUserProgram = $updateUserProgram;
    }

    public function saveUserProgram($data) 
    {
        $count = 0;
        
        foreach($data->courses as $course) {
            $this->createUserProgram->execute([
                'user_id'               =>  $data->user()->id,
                'program_id'            =>  $course['id'],
                'course_id'             =>  $data->program_id,
                'start_date'            =>  $data->start_date,
                'end_date'              =>  $data->end_date,
                'hours_needed'          =>  $data->hours_needed,
                'application_status'    =>  'New Learner',
                'returnee'              =>  $data->returnee
            ]);

            $count += 1;
        }

        $this->createLog->execute([
            'user_id'   =>  $data->user()->id,
            'action'    =>  'Enrolled ' . $count . ' course(s).'
        ]);
    }

    public function addUserProgramOnSuperadmin($data)
    {
        $this->createUserProgram->execute([
            'user_id'           =>  $data->user_id,
            'program_id'        =>  $data->course_id,
            'course_id'         =>  $data->program_id,
            'start_date'        =>  $data->start_date,
            'end_date'          =>  $data->end_date,
            'hours_needed'      =>  $data->hours_needed,
            'application_status'=>  $data->application_status,
            'returnee'          =>  $data->returnee
        ]);

        $this->createLog->execute([
            'user_id'   =>  $data->user()->id,
            'action'    =>  'Added course on user_id ' . $data->user_id . '.'
        ]);
    }

    public function update($data)
    {
        $this->updateUserProgram->execute(['id' => $data->id], [
            'user_id'               => $data->user_id,
            'program_id'            => $data->program_id,
            'course_id'             => $data->course_id,
            'start_date'            => $data->start_date,
            'end_date'              => $data->end_date,
            'hours_needed'          => $data->hours_needed,
            'application_status'    => $data->application_status,
            'returnee'              => $data->returnee
        ]);

        switch($data->user()->role) {
            case 'client':
                $this->createLog->execute([
                    'user_id'   =>  $data->user()->id,
                    'action'    =>  'User program id ' . $data->id . ' has been updated.'
                ]);
            break;
            case 'superadministrator':
                $this->createLog->execute([
                    'user_id'   =>  $data->user()->id,
                    'action'    =>  'User program id ' . $data->id . ' has been updated.'
                ]);
            break;
        }
    }

    public function updateStatus($data, $userProgramId)
    {
        $this->updateUserProgram->execute(['id' => $userProgramId], [
            'application_status' => $data->status
        ]);

        $this->createLog->execute([
            'user_id'   =>  $data->user()->id,
            'action'    =>  'User program id ' . $userProgramId . ' set status to ' . $data->status .'.' 
        ]);
    }

    public function removeProgram($data, $userProgramId)
    {
        $isUserProgramLinkedToPayment = Payment::where('course_id', $userProgramId)->first();
        
        if (!empty($isUserProgramLinkedToPayment)) {
            throw new UserProgramIsAlreadyLinkedException();
        }

        UserProgram::where('id', $userProgramId)->delete();

        switch($data->user()->role) {
            case 'client':
                $this->createLog->execute([
                    'user_id'   =>  $data->user()->id,
                    'action'    =>  'Deleted a program track'
                ]);
            break;

            case 'superadministrator':
                $this->createLog->execute([
                    'user_id'   =>  $data->user()->id,
                    'action'    =>  'Deleted a program track id: '. $userProgramId
                ]);
            break;
        }
    }
}