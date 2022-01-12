<?php
namespace App\Repositories\Job;

use App\Models\JobSalary;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class JobSalaryRepository
 * @package App\Repository
 */
class JobSalaryRepository implements RepositoryInterface {

    /**
     * @var JobSalary
     */
    protected $jobSalary;

    /**
     * @param JobSalary $jobSalary
     */
    public function __construct(JobSalary $jobSalary)
    {
        $this->jobSalary = $jobSalary;
    }

    /**
     * Create New Job Payment Log
     *
     * @param array $jobSalaryData
     * @return JobSalary|null
     */
    public function create($jobSalaryData)
    {
        $jobSalary = $this->jobSalary::firstOrNew(['job_id' => $jobSalaryData['job_id']]);

        $jobSalary->currency_type = $jobSalaryData['jobSalaryCurrency'];
        $jobSalary->range_from = $jobSalaryData['jobSalaryFrom'];
        $jobSalary->range_to = $jobSalaryData['jobSalaryTo'];
        $jobSalary->rate = $jobSalaryData['jobSalaryType'];
        $jobSalary->job_id = $jobSalaryData['job_id'];

        $jobSalary->save();

        return $jobSalary->fresh();
    }

    /**
     * Get Job Payment log by ID
     *
     * @param $jobSalary_id
     * @return JobSalary
     */
    public function findById($jobSalary_id)
    {
        return $this->jobSalary->find($jobSalary_id);
    }

    /**
     * Get Job Payment log by ID
     *
     * @param $jobSalary_id
     * @return JobSalary
     */
    public function findAll()
    {
        return $this->jobSalary->all();
    }
}