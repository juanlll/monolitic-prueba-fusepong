<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectRepository;
use Flash;

final class ShowProjectController extends AppBaseController
{

    /** @var  ProjectRepository */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    public function __invoke($id)
    {
        $project = $this->projectRepository->find($id);
        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('companies.index'));
        }
        return view('projects.show')->with('project', $project);
    }
}
