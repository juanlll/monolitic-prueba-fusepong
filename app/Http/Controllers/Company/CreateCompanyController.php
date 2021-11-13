<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\AppBaseController;
use Flash;

final class CreateCompanyController extends AppBaseController
{

    public function __invoke($id)
    {
        return view('companies.create');
    }
}
