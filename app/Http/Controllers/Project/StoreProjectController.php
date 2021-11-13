<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateProjectRequest;
use App\Repositories\ProjectRepository;
use Flash;

final class StoreCompanyController extends AppBaseController
{
    /** @var  ProjectRepository */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    public function __invoke(CreateProjectRequest $request)
    {
        $input = $request->all();
        $project = $this->projectRepository->create($input);
        Flash::success('Project saved successfully.');
        return redirect(route('companies.index').'/'.$project->company_id);
    } 
}
