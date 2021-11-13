<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Repositories\CompanyRepository;
use Flash;
use Illuminate\Support\Facades\Auth;

final class EditProjectController extends AppBaseController
{

    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function __invoke($id)
    {
        $project = $this->projectRepository->find($id);
        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('companies.index'));
        }
        $companies = $this->companyRepository->getCompaniesWithUser(Auth::user()->id);
        return view('projects.edit', ['project' => $project,'companies' => $companies]);
    }
}
