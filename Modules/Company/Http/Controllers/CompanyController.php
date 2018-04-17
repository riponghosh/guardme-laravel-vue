<?php

namespace Modules\Company\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Company\Http\Resources\CompanyResource;
use Modules\Company\Repositories\CompanyRepository;

class CompanyController extends Controller
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * CompanyController constructor.
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function saveCompany()
    {
        $data = \request()->all();

        $company = $this->companyRepository->saveCompany(auth()->user()->id, $data);

        return new CompanyResource($company);
    }

    public function getAuthUserCompanies()
    {
        $companies = $this->companyRepository->getCompaniesByUserId(auth()->user()->id);

        return CompanyResource::collection($companies);
    }
}
