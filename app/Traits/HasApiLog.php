<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait HasApiLog
{
    public function withApiLog(string $log_message, ?Model $causer = null, string $log_name = 'api')
    {
        $activity = activity()
            ->useLog($log_name)
            ->performedOn($this->model)
            ->withProperties(request()->all(['_token', '_method']));

        if (is_null($causer)) {
            $activity = $activity->causedByAnonymous();
        } else {
            $activity = $activity->causedBy($causer);
        }

        $activity->log(ucwords(implode(' ', preg_split('/(?=[A-Z])/', $log_message))));

        return $this;
    }
}
