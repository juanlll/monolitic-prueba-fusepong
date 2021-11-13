<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\ProjectRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Company;
use Response;
use Datatables;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectController extends AppBaseController
{
    /** @var  ProjectRepository */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    /**
     * Display a listing of the Project.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {   

        $input = $request->all();
        
        if ($request->ajax()) {
            if(isset($input['companyId'])){
                $projects = Project::query()->with('company')->where('company_id',$input['companyId'])->select('projects.*');
            }else{
                $projects = Project::query()->with('company')->select('projects.*');
            }
            return Datatables::of($projects)->make(true);
        }
    
        return view('projects.index');
    }

    /**
     * Show the form for creating a new Project.
     *
     * @return Response
     */
    public function create()
    {   
        $companies = Company::whereHas('users', function($query){ 
            return $query->where('users.id', Auth::user()->id);
        })->get();
        
        return view('projects.create',['companies'=>$companies]);
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param CreateProjectRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();
        
        $project = $this->projectRepository->create($input);

        Flash::success('Project saved successfully.');

        return redirect(route('companies.index').'/'.$project->company_id);
    }

    /**
     * Display the specified Project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('companies.index'));
        }

        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified Project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('companies.index'));
        }

        $companies = Company::whereHas('users', function($query){ 
            return $query->where('users.id', Auth::user()->id);
        })->get();

        return view('projects.edit', ['project' => $project,'companies' => $companies]);
    }

    /**
     * Update the specified Project in storage.
     *
     * @param  int              $id
     * @param UpdateProjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectRequest $request)
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

    /**
     * Remove the specified Project from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $project = $this->projectRepository->find($id);

        $project->delete();

        return $this->sendSuccess('Project deleted successfully.');
    }
}
