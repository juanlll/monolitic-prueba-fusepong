<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCompanyRequest;
use App\Repositories\CompanyRepository;
use Flash;
use Illuminate\Support\Facades\Auth;

final class StoreCompanyController extends AppBaseController
{
    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
    }

    public function __invoke(CreateCompanyRequest $request)
    {
        $input = $request->all();
        $company = $this->companyRepository->create($input);
        $company->users()->sync([Auth::user()->id]);
        Flash::success('Company saved successfully.');
        return redirect(route('companies.index'));
    } 
}
