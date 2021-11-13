<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateCompanyRequest;
use App\Repositories\CompanyRepository;
use Flash;

final class UpdateCompanyController extends AppBaseController
{
    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
    }

    public function __invoke($id, UpdateCompanyRequest $request)
    {
        $company = $this->companyRepository->find($id);

        if (empty($company)) {
            Flash::error('Company not found');
            return redirect(route('companies.index'));
        }

        $company = $this->companyRepository->update($request->all(), $id);
        Flash::success('Company updated successfully.');
        return redirect(route('companies.index'));
    }
}
