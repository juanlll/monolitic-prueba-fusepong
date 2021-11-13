<?php

namespace App\Http\Controllers;

use App\DataTables\UserStoryDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserStoryRequest;
use App\Http\Requests\UpdateUserStoryRequest;
use App\Repositories\UserStoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Project;
use App\Models\UserStory;
use Response;
use Datatables;
use Illuminate\Support\Facades\Auth;

class UserStoryController extends AppBaseController
{
    /** @var  UserStoryRepository */
    private $userStoryRepository;

    public function __construct(UserStoryRepository $userStoryRepo)
    {
        $this->userStoryRepository = $userStoryRepo;
    }

    /**
     * Display a listing of the UserStory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {   
        $input = $request->all();
        
        if ($request->ajax()) {
            if(isset($input['projectId'])){
                $userStories = UserStory::query()->with('project')->where('project_id',$input['projectId'])->select('user_stories.*');
            }else{
                $userStories = UserStory::query()->with('project')->select('user_stories.*');
            }
            return Datatables::of($userStories)->make(true);
        }
    
        return view('user_stories.index');
    }

    /**
     * Show the form for creating a new UserStory.
     *
     * @return Response
     */
    public function create()
    {   
        $projects = Project::whereHas('company', function($query){ 
            return $query->whereHas('users', function($query){ 
                return $query->where('users.id', Auth::user()->id);
            });
        })->get();

        return view('user_stories.create',['projects'=>$projects]);
    }

    /**
     * Store a newly created UserStory in storage.
     *
     * @param CreateUserStoryRequest $request
     *
     * @return Response
     */
    public function store(CreateUserStoryRequest $request)
    {
        $input = $request->all();

        $userStory = $this->userStoryRepository->create($input);

        Flash::success('User Story saved successfully.');

        return redirect(route('userStories.index'));
    }

    /**
     * Display the specified UserStory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userStory = $this->userStoryRepository->find($id);

        if (empty($userStory)) {
            Flash::error('User Story not found');

            return redirect(route('userStories.index'));
        }

        return view('user_stories.show')->with('userStory', $userStory);
    }

    /**
     * Show the form for editing the specified UserStory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userStory = $this->userStoryRepository->find($id);

        if (empty($userStory)) {
            Flash::error('User Story not found');

            return redirect(route('userStories.index'));
        }

        $projects = Project::whereHas('company', function($query){ 
            return $query->whereHas('users', function($query){ 
                return $query->where('users.id', Auth::user()->id);
            });
        })->get();

        return view('user_stories.edit',['userStory'=>$userStory,'projects'=>$projects]);
    }

    /**
     * Update the specified UserStory in storage.
     *
     * @param  int              $id
     * @param UpdateUserStoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserStoryRequest $request)
    {
        $userStory = $this->userStoryRepository->find($id);

        if (empty($userStory)) {
            Flash::error('User Story not found');

            return redirect(route('userStories.index'));
        }

        $userStory = $this->userStoryRepository->update($request->all(), $id);

        Flash::success('User Story updated successfully.');

        return redirect(route('userStories.index'));
    }

    /**
     * Remove the specified UserStory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userStory = $this->userStoryRepository->find($id);

        $userStory->delete();

        return $this->sendSuccess('User Story deleted successfully.');
    }
}
