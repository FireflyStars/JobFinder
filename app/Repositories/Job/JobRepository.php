<?php
namespace App\Repositories\Job;

use App\Models\Job;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class JobRepository
 * @package App\Repository
 */
class JobRepository implements RepositoryInterface {

    /**
     * @var Job
     */
    protected $job;

    /**
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * Create New Job
     *
     * @param array $jobData
     * @return Job|null
     */
    public function create($jobData)
    {
        $job = (isset($jobData['job_id']) && $jobData['job_id']) ? $this->findById($jobData['job_id']) : new Job();

        $job->title = $jobData['jobTitle'];
        $job->location = $jobData['jobLocation'];
        $job->location_detail = $jobData['jobLocationDetail'];
        $job->job_type = $jobData['jobType'];
        $job->apply_link = $jobData['jobApplyLink'];
        $job->description = $jobData['jobDescription'];
        $job->is_premium = $jobData['isPremium'];
        $job->creation_step = $jobData['creationStep'];
        $job->category_id = $jobData['jobCategory'];
        $job->company_id = $jobData['companyId'];
        
        $job->save();

        return $job->fresh();
    }

    /**
     * Update Job
     *
     * @param array $jobData
     * @return Job|null
     */
    public function update($jobId, $jobData)
    {
        $job = $this->findById($jobId);

        if(isset($jobData['jobTitle'])) {
            $job->title = $jobData['jobTitle'];
        }
        
        if(isset($jobData['jobLocation'])) {
            $job->location = $jobData['jobLocation'];
        }

        if(isset($jobData['jobLocationDetail'])) {
            $job->location_detail = $jobData['jobLocationDetail'];
        }

        if(isset($jobData['jobType'])) {
            $job->job_type = $jobData['jobType'];
        }

        if(isset($jobData['jobApplyLink'])) {
            $job->apply_link = $jobData['jobApplyLink'];
        }

        if(isset($jobData['jobDescription'])) {
            $job->description = $jobData['jobDescription'];
        }

        if(isset($jobData['isPremium'])) {
            $job->is_premium = $jobData['isPremium'];
        }

        if(isset($jobData['creationStep'])) {
            $job->creation_step = $jobData['creationStep'];
        }

        if(isset($jobData['jobCategory'])) {
            $job->category_id = $jobData['jobCategory'];
        }

        if(isset($jobData['companyId'])) {
            $job->company_id = $jobData['companyId'];
        }
        
        $job->save();

        return $job->fresh();
    }

    /**
     * Get Job by ID
     *
     * @param $job_id
     * @return Job
     */
    public function findById($job_id)
    {
        return $this->job->with('company', 'salary', 'paymentLog')->find($job_id);
    }

    /**
     * Get Job by ID
     *
     * @param $job_id
     * @return Job
     */
    public function findAll()
    {
        return $this->job->with('company', 'salary', 'paymentLog')->all();
    }

    /**
     * Get Job by query params
     *
     * @param $job_id
     * @return Job
     */
    public function paginated($q = "", $category = "all")
    {
        $this->job = $this->job->where('title', 'like', '%' . $q . '%');
        if($category && $category != "all") {
            $this->job->where('category_id', '=', $category);
        }

        return $this->job->orderBy('id', 'desc')->paginate(15);
    }

    /**
     * Get premium jobs with pagination
     *
     * @param $job_id
     * @return Job
     */
    public function premiumPaginated()
    {
        return $this->job->where('is_premium', '=', 1)->orderBy('id', 'desc')->paginate(15);
    }

    /**
     * Get new jobs posted today
     *
     * @return Job
     */
    public function newJobsTodayCount()
    {
        return $this->job->whereDate('created_at', \Carbon\Carbon::today())->orderBy('id', 'desc')->count();
    }

    /**
     * Update key with new value by id
     *
     * @param array $jobId
     * @param string $key
     * @param string $value
     * @return JobPaymentLog|null
     */
    public function updateKeyById($jobId, $key, $value)
    {
        $job = $this->findById($jobId);
        $job->$key = $value;

        return $job->save();
    }
}