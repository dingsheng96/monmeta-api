<?php

namespace App\Support\Services;

use App\Models\User;
use App\Support\Services\BaseService;
use Illuminate\Auth\AuthenticationException;

class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function checkUser()
    {
        if (!$this->model->exists) {

            $user = $this->getUserDetailsFromOtherPlatform();

            throw_if(!$user, new AuthenticationException('User does not exists. Please register!'));
        }

        foreach ($this->model->tokens as $token) {
            $token->revoke();
        }

        return $this;
    }

    public function storeUserDetails()
    {
        $this->model->wallet_id = $this->request->get('walletId');
        $this->model->username = $this->request->get('userName');
        $this->model->first_name = $this->request->get('firstName');
        $this->model->last_name = $this->request->get('lastName');
        $this->model->email = $this->request->get('email');
        $this->model->contact_no = $this->request->get('contactNo');
        $this->model->nationality_id = $this->request->get('nationality');
        $this->model->personal_id_type = $this->request->get('personalIdType');
        $this->model->personal_id_no = $this->request->get('personalIdNo');

        if ($this->model->isDirty()) {
            $this->model->save();
        }

        return $this;
    }

    public function getUserDetailsFromOtherPlatform()
    {
        return false;
    }
}
