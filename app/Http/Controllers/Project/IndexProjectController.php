<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Models\Project;
use Illuminate\Http\Request;
use Datatables;

final class IndexProjectController extends AppBaseController
{

    public function __invoke(Request $request)
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
}
