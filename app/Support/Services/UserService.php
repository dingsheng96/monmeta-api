<?php

namespace App\Support\Services;

use App\Models\User;
use App\Models\Country;
use App\Support\Services\BaseService;

class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function checkUser()
    {
        $this->model->wallet_id = $this->request->get('walletId');

        if ($this->model->isDirty()) {
            $this->model->save();
        }

        if (!$this->model->wasRecentlyCreated) {
            foreach ($this->model->tokens as $token) {
                $token->revoke();
            }
        } else {
            $this->getUserDetailsFromOtherPlatform();
        }

        return $this;
    }

    public function storeUserDetails()
    {
        $this->model->username = $this->request->get('userName');
        $this->model->first_name = $this->request->get('firstName');
        $this->model->last_name = $this->request->get('lastName');
        $this->model->email = $this->request->get('email');
        $this->model->contact_no = $this->request->get('contactNo');
        $this->model->nationality = $this->request->get('nationality');
        $this->model->personal_id_type = $this->request->get('personalIdType');
        $this->model->personal_id_no = $this->request->get('personalIdNo');

        if ($this->model->isDirty()) {
            $this->model->save();
        }

        return $this;
    }

    public function getUserDetailsFromOtherPlatform()
    {
        return $this;
    }
}
