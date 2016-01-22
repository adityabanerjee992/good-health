<?php

namespace App\Http\Contracts;

interface Address
{
    /**
     * Create new address
     *
     * @param 
     * 
     * @return 
     */
    public function create();

    /**
     * Store a newly created address in storage.
     *
     * @return Response
     */
    public function store();

    /**
     * Display the specified address.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id);
}