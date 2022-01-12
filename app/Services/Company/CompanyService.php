<?php
namespace App\Services\Company;

use App\Models\Company;
use App\Repositories\Company\CompanyRepository;

/**
 * Class CompanyService
 * @package App\Services\Company
 */
class CompanyService {

    protected $companyRepository;

    /**
     * @param CompanyRepository $company
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    
    /**
     * Get Company by ID
     *
     * @param $company_id
     * @return Company
     */
    public function find($company_id)
    {
        try {
            return $this->companyRepository->findById($company_id);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

     /**
     * Get Company by Email
     *
     * @param $company_email
     * @return Company
     */
    public function findByEmail($company_email)
    {
        try {
            return $this->companyRepository->findByEmail($company_email);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Get All Companies
     *
     * @return Company
     */
    public function findAll()
    {
        try {
            return $this->companyRepository->findAll();
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Create New Company
     *
     * @param array $companyData
     * @return Company|null
     */
    public function create($companyData)
    {
        try {
            return $this->companyRepository->create($companyData);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Update Company
     *
     * @param array $companyData
     * @return Company|null
     */
    public function update($id, $companyData)
    {
        try {
            return $this->companyRepository->update($id, $companyData);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }
}