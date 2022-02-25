<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\Master\User\UserResetPasswordRequest;
use App\Http\Requests\Master\User\UserUpdateRequest;
use App\Http\Requests\Master\User\UserVerifyRequest;
use App\Http\Requests\Organization\Basic\Employee\EmployeeStoreRequest;
use App\Mail\RegisterMail;
use App\Http\Controllers\Controller;
use App\Services\RandomGenerationService;
use Illuminate\Support\Facades\Mail;
use App\Services\Master\User\UserService;
use App\Http\Requests\Master\User\UserStoreUpdateRequest;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends Controller
{
    protected UserService $userService;
    protected RandomGenerationService $randomGenerationService;
    protected AccessTokenController $accessTokenController;

    public function __construct(
        UserService             $userService,
        RandomGenerationService $randomGenerationService,
        AccessTokenController   $accessTokenController
    )
    {
        $this->userService = $userService;
        $this->randomGenerationService = $randomGenerationService;
        $this->accessTokenController = $accessTokenController;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->userService->getPaginate($indexRequest);
    }

    public function update($id, UserUpdateRequest $userUpdateRequest)
    {
        return $this->userService->edit($id, $userUpdateRequest->validated());
    }

    public function show()
    {
        return $this->userService->show(auth()->id(), ['organization', 'view_employee', 'language']);
    }

    public function employee(EmployeeStoreRequest $employeeStoreRequest)
    {
        return $this->userService->employeeStore($employeeStoreRequest->validated());
    }

    public function register(UserStoreUpdateRequest $userStoreUpdateRequest)
    {
        $data = $userStoreUpdateRequest->validated();
        $generated_key = $this->randomGenerationService->string(8);
        $data['password'] = bcrypt($generated_key);
        $data['verification_token'] = $this->randomGenerationService->string(100);
        $user = $this->userService->store($data);
        $user_data = $user->getData();
        return $this->sendEmail($user_data, $data['host_name'], $generated_key);
    }

    public function verify(UserVerifyRequest $userVerifyRequest)
    {
        $request = $userVerifyRequest->validated();
        return $this->userService->verify($request['token']);
    }

    public function sendEmail($data, $host_name, $key)
    {
        Mail::to($data->username)->send(new RegisterMail($data, $host_name, $key));
        return response()->json([
            'message' => 'Email has been sent.'
        ]);
    }

    public function resetPassword($id, UserResetPasswordRequest $userResetPasswordRequest)
    {
        return $this->userService->resetPassword($id, $userResetPasswordRequest->validated());
    }

    public function login(ServerRequestInterface $request)
    {
        return $this->accessTokenController->issueToken($request);
    }

}
