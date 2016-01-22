<?php namespace App\Http\Controllers\Admin\Contracts;

interface UserManagement {

    /**
     * Display a listing of the users.
     *
     * @return Response
     */
    public function index();

	/**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create();

     /**
     * Store a newly created user in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    // public function store(Request $request);

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id);

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id);

    // /**
    //  * Update the specified user in storage.
    //  *
    //  * @param  Request  $request
    //  * @param  int  $id
    //  * @return Response
    //  */
    // public function update(Request $request, $id);

    // /**
    //  * Remove the specified user from storage.
    //  *
    //  * @param  int  $id
    //  * @return Response
    //  */
    // public function destroy($id);        
}

?>