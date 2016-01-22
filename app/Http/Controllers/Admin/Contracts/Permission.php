<?php namespace App\Http\Controllers\Admin\Contracts;

interface Permission
{
    /**
     * Display a listing of the roles.
     *
     * @return Illuminate\Contracts\View\Factory
     */
    public function index();

    /**
     * Show the form for creating a new role.
     *
     * @return Illuminate\Contracts\View\Factory
     */
    public function create();

    
}