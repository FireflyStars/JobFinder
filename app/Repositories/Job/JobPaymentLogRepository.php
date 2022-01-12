<?php
namespace App\Repositories\Job;

use App\Models\JobPaymentLog;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class JobPaymentLogRepository
 * @package App\Repository
 */
class JobPaymentLogRepository implements RepositoryInterface {

    /**
     * @var JobPaymentLog
     */
    protected $jobPaymentLog;

    /**
     * @param JobPaymentLog $jobPaymentLog
     */
    public function __construct(JobPaymentLog $jobPaymentLog)
    {
        $this->jobPaymentLog = $jobPaymentLog;
    }

    /**
     * Create New Job Payment Log
     *
     * @param array $jobPaymentLogData
     * @return JobPaymentLog|null
     */
    public function create($jobPaymentLogData)
    {
        if(!isset($jobPaymentLogData['job_id'])) {
            return null;
        }

        $jobPaymentLog = $this->jobPaymentLog::firstOrNew(['job_id' => $jobPaymentLogData['job_id']]);

        if(isset($jobPaymentLogData['currency'])) {
            $jobPaymentLog->currency = $jobPaymentLogData['currency'];
        }
        
        if(isset($jobPaymentLogData['price'])) {
            $jobPaymentLog->price = $jobPaymentLogData['price'];
        }

        if(isset($jobPaymentLogData['payment_id'])) {
            $jobPaymentLog->payment_id = $jobPaymentLogData['payment_id'];
        }

        if(isset($jobPaymentLogData['status'])) {
            $jobPaymentLog->status = $jobPaymentLogData['status'];
        }
        
        $jobPaymentLog->job_id = $jobPaymentLogData['job_id'];

        $jobPaymentLog->save();

        return $jobPaymentLog->fresh();
    }

    /**
     * Get Job Payment log by ID
     *
     * @param $jobPaymentLog_id
     * @return JobPaymentLog
     */
    public function findById($jobPaymentLog_id)
    {
        return $this->jobPaymentLog->find($jobPaymentLog_id);
    }

    /**
     * Get Job Payment log by ID
     *
     * @param $jobPaymentLog_id
     * @return JobPaymentLog
     */
    public function findAll()
    {
        return $this->jobPaymentLog->all();
    }

    /**
     * Update key with new value by job id
     *
     * @param array $jobId
     * @param string $key
     * @param string $value
     * @return JobPaymentLog|null
     */
    public function updateKeyByJobId($jobId, $key, $value)
    {
        $jobPaymentLog = $this->jobPaymentLog->where('job_id', $jobId)->get()->first();
        $jobPaymentLog->$key = $value;

        return $jobPaymentLog->save();
    }
}