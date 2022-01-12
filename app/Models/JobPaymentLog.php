<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPaymentLog extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_payment_logs';
    protected $guarded = [];
    protected $timestamp = true;

    /**
     * Get the job that has the salary.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}

?>