<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Repositories\CompanyRepository;
use Flash;

final class EditCompanyController extends AppBaseController
{

    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
    }

    public function __invoke($id)
    {
        try {
            $company = $this->companyRepository->find($id);
            if (empty($company)) {
                Flash::error('Company not found');
                return redirect(route('companies.index'));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return view('companies.edit')->with('company', $company);
    }
}
