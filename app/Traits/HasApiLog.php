<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait HasApiLog
{
    protected $properties = [];

    protected $subject, $causer;

    public function saveApiLog(string $log_message, string $log_name = 'api')
    {
        $activity = activity()
            ->useLog($log_name)
            ->withProperties($this->properties);

        $activity = is_null($this->causer)
            ? $activity->causedByAnonymous()
            : $activity->causedBy($this->causer);

        if (!is_null($this->subject)) {
            $activity = $activity->performedOn($this->subject);
        }

        $activity->log(ucwords(implode(' ', preg_split('/(?=[A-Z])/', $log_message))));

        return $this;
    }

    public function setProperties(array $properties = []): self
    {
        $this->properties = $properties;

        return $this;
    }

    public function setSubject(Model $subject = null): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function setCauser(Model $causer = null): self
    {
        $this->causer = $causer;

        return $this;
    }
}
