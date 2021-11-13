<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectRepository;

final class DeleteCompanyController extends AppBaseController
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
        $project->delete();
        return $this->sendSuccess('Project deleted successfully.');
    }
}
