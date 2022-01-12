<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSalary extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_salary';
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