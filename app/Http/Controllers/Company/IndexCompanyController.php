<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datatables;

final class IndexCompanyController extends AppBaseController
{

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $companyRepo)
    {
        $this->userRepository = $companyRepo;
    }

    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $companies = $this->userRepository->getMyCompanies(Auth::user()->id);
            return Datatables::of($companies)->make();
        }
        return view('companies.index');
    }
}
