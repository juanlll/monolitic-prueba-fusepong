<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\ProjectRepository;
use Flash;

final class UpdateProjectController extends AppBaseController
{
    /** @var  ProjectRepository */
    private $projectRepository;

    public function __construct(ProjectRepository $companyRepo)
    {
        $this->projectRepository = $companyRepo;
    }

    public function __invoke($id, UpdateProjectRequest $request)
    {
        $project = $this->projectRepository->find($id);
        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('companies.index').'/'.$project->company_id);
        }
        $project = $this->projectRepository->update($request->all(), $id);
        Flash::success('Project updated successfully.');
        return redirect(route('companies.index').'/'.$project->company_id);
    }
}
