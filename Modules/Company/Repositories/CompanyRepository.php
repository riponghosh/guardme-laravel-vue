<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 26/01/2018
 * Time: 06:04 PM
 */

namespace Modules\Company\Repositories;


use Modules\Company\Models\Company;

class CompanyRepository
{
    /**
     * @var Company
     */
    private $company;


    /**
     * CompanyRepository constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function saveCompany($user_id, array $data)
    {
        return $this->company->create([
            'user_id' => $user_id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone'],
        ]);
    }

    public function getCompaniesByUserId($user_id)
    {
        return $this->company->where('user_id', $user_id)->get();
    }

    /**
     * @param $company_id
     * @return Company
     */
    public function getById($company_id)
    {
        return $this->company->find($company_id);
    }
}