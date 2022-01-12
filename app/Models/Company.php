<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';
    protected $guarded = [];
    protected $timestamp = true;

    /**
     * Get the jobs belongs to the company.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}

?>