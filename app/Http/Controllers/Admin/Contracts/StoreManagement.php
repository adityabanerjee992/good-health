<?php namespace App\Http\Controllers\Admin\Contracts; 

interface StoreManagement {

    /**
     * Display a listing of the stores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index();

    /**
     * Show the form for creating a new store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create();

    /**
     * Store a newly created store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Request $request);

    /**
     * Display the specified store.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id);

    /**
     * Show the form for editing the specified store.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id);

    /**
     * Update the specified store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\Request $request, $id);

    /**
     * Remove the specified store from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id);    
}

?>