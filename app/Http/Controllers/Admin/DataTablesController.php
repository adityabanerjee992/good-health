<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Datatables;

class DataTablesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.examples.datatables');
    }

    public function data()
    {
        $users = User::select(['id', 'first_name', 'last_name', 'email']);

        return Datatables::of($users)
            ->add_column('actions','<a href="{{ route(\'users.show\', $id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                                    <a href="{{ route(\'users.update\', $id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>
                					<a href="{{ route(\'confirm-delete/user\', $id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>
                				   ')
            ->make(true);
    }
}
