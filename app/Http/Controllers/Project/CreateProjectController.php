<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Repositories\CompanyRepository;
use Flash;
use Illuminate\Support\Facades\Auth;

final class CreateProjectController extends AppBaseController
{

    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    
    public function __invoke($id)
    {
        $companies = $this->companyRepository->getCompaniesWithUser(Auth::user()->id);
        return view('projects.create', ['companies'=>$companies]);
    }
}
