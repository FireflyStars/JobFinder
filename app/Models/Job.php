<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs';
    protected $guarded = [];
    protected $timestamp = true;

    /**
     * Get the salary associated with the job.
     */
    public function salary()
    {
        return $this->hasOne(JobSalary::class);
    }

    /**
     * Get the payment associated with the job.
     */
    public function paymentLog()
    {
        return $this->hasOne(JobPaymentLog::class);
    }

    /**
     * Get the category that job belongs.
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the company that job belongs.
    */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

?>