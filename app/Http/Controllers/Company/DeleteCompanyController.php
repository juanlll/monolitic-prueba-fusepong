<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Repositories\CompanyRepository;
use Flash;

final class DeleteCompanyController extends AppBaseController
{

    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
    }

    public function __invoke($id)
    {
        $company = $this->companyRepository->find($id);
        $company->delete();
        return $this->sendSuccess('Company deleted successfully.');
    }
}
