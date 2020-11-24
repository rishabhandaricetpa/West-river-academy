<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait MustVerifyEmail
{
    public function initializeMustVerifyEmail()
    {
        $this->mergeCasts([
            $this->getEmailVerifiedAtColumn() => 'datetime',
        ]);
    }

    public function getEmailVerifiedAtColumn()
    {
        return 'email_verified_at';
    }

    public function hasVerifiedEmail()
    {
        return ! is_null($this->{$this->getEmailVerifiedAtColumn()});
    }

    public function setEmailAsVerified()
    {
        return $this->forceFill([
            $this->getEmailVerifiedAtColumn() => $this->freshTimestamp(),
        ]);
    }

    public function scopeHasVerifiedEmail(Builder $query)
    {
        return $query->whereNotNull($this->getEmailVerifiedAtColumn());
    }
}
