<?php

namespace App\Support\Services;

use App\Traits\HasApiLog;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    use HasApiLog;

    public $request, $model, $log;

    public function __construct($model)
    {
        $this->setModel(new $model());
    }

    public function setModel(Model $model)
    {
        $this->model = $model;

        return $this;
    }

    public function getModel()
    {
        $this->model->refresh();

        return $this->model;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }
}
