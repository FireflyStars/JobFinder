<?php
namespace App\Services\Job;

use App\Models\Job;
use App\Repositories\Job\JobRepository;
use App\Repositories\Job\JobSalaryRepository;
use App\Repositories\Job\JobPaymentLogRepository;

/**
 * Class JobService
 * @package App\Services\Job
 */
class JobService {

    /**
     * @var jobRepository
     */
    protected $jobRepository;

     /**
     * @var jobSalaryRepository
     */
    protected $jobSalaryRepository;

     /**
     * @var jobPaymentLogRepository
     */
    protected $jobPaymentLogRepository;

    /**
     * @param JobRepository $job
     */
    public function __construct(JobRepository $jobRepository, JobSalaryRepository $jobSalaryRepository, JobPaymentLogRepository $jobPaymentLogRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->jobSalaryRepository = $jobSalaryRepository;
        $this->jobPaymentLogRepository = $jobPaymentLogRepository;
    }
    
    /**
     * Get Job by ID
     *
     * @param $job_id
     * @return Job
     */
    public function find($job_id)
    {
        try {
            return $this->jobRepository->findById($job_id);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Get Jobs by pagination
     *
     * @param $q
     * @return Job
     */
    public function findAllWithPagination($q = "", $category = "")
    {
        try {
            return $this->jobRepository->paginated($q, $category);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Get Jobs by pagination
     *
     * @param $q
     * @return Job
     */
    public function findPremiumWithPagination()
    {
        try {
            return $this->jobRepository->premiumPaginated();
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Get count of jobs poted today
     *
     * @return Job
     */
    public function findCountNewJobsToday()
    {
        try {
            return $this->jobRepository->newJobsTodayCount();
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Create New Job
     *
     * @param array $jobData
     * @return Job|null
     */
    public function create($jobData)
    {
        try {
            $job =  $this->jobRepository->create($jobData);

            $jobData['job_id'] = $job['id'];
            
            if($jobData['jobSalaryFrom'] && $jobData['jobSalaryTo']) {
                // create job salary
                $jobSalary = $this->jobSalaryRepository->create($jobData);
            }

            return $job;
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Update job
     *
     * @param int $id
     * @param array $jobData
     * @return Job|null
     */
    public function update($id, $jobData)
    {
        try {
            $job =  $this->jobRepository->update($id, $jobData);

            $jobData['job_id'] = $job['id'];
            
            if(isset($jobData['jobSalaryFrom']) && isset($jobData['jobSalaryTo'])) {
                // create job salary
                $jobSalary = $this->jobSalaryRepository->create($jobData);
            }

            return $job;
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Create New Job payment log
     *
     * @param array $jobData
     * @return JobPaymentLog|null
     */
    public function createPaymentLog($jobData)
    {
        try {
            return $this->jobPaymentLogRepository->create($jobData);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Update payment log status by job id
     *
     * @param array $jobId
     * @param boolean $status
     * @return JobPaymentLog|null
     */
    public function updatePaymentLogStatusByJobId($jobId, $status)
    {
        try {
            return $this->jobPaymentLogRepository->updateKeyByJobId($jobId, 'status', $status);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Update job creation step by id
     *
     * @param array $jobId
     * @param int $step
     * @return Job|null
     */
    public function updateJobCreationStepById($jobId, $step)
    {
        try {
            return $this->jobRepository->updateKeyById($jobId, 'creation_step', $step);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }
}