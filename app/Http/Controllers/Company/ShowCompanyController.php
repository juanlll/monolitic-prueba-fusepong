<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Repositories\CompanyRepository;
use Flash;

final class ShowCompanyController extends AppBaseController
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
        if (empty($company)) {
            Flash::error('Company not found');
            return redirect(route('companies.index'));
        }
        return view('companies.show')->with('company', $company);
    }
}
