<?php
namespace App\Repositories\Company;

use App\Models\Company;
use App\Interfaces\RepositoryInterface;
use App\Models\Category;

/**
 * Class CompanyRepository
 * @package App\Repository
 */
class CompanyRepository implements RepositoryInterface {

    /**
     * @var Company
     */
    protected $company;

    /**
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Create New Company
     *
     * @param array $companyData
     * @return Company|null
     */
    public function create($companyData)
    {
       $company = new Company();
        
        $company->name = $companyData['companyName'];
        $company->statement = $companyData['companyStatement'];
        if(isset($companyData['companyLogoPath']) && $companyData['companyLogoPath']) {
            $company->logo = $companyData['companyLogoPath'];
        }
        $company->email = $companyData['companyEmail'];
        $company->website = $companyData['companyWebsite'];
        $company->twitter = $companyData['companyTwitter'];
        $company->location = $companyData['companyLocation'];
        $company->description = $companyData['companyDescription'];
        $company->save();
        
        return $company;
    }

    /**
     * Update Company
     *
     * @param array $companyData
     * @return Company|null
     */
    public function update($companyId, $companyData)
    {
        
        $company = $this->findById($companyId);

        $company->name = $companyData['companyName'];
        $company->statement = $companyData['companyStatement'];
        if(isset($companyData['companyLogoPath']) && $companyData['companyLogoPath']) {
            $company->logo = $companyData['companyLogoPath'];
        }
        $company->email = $companyData['companyEmail'];
        $company->website = $companyData['companyWebsite'];
        $company->twitter = $companyData['companyTwitter'];
        $company->location = $companyData['companyLocation'];
        $company->description = $companyData['companyDescription'];
        
        $company->save();
     
        return $company->fresh();
    }

    /**
     * Get Company by ID
     *
     * @param $company_id
     * @return Company
     */
    public function findById($company_id)
    {
        return $this->company->findOrFail($company_id);
    }

    /**
     * Get Company by Email
     *
     * @param $company_email
     * @return Company
     */
    public function findByEmail($company_email)
    {
        return $this->company->where('email', $company_email)->first();
    }

    /**
     * Get Company by ID
     *
     * @param $company_id
     * @return Company
     */
    public function findAll()
    {
        return $this->company->all();
    }
}