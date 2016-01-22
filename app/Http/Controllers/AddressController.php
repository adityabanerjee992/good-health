<?php namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Contracts\Address as AddressContract;
use App\Http\Controllers\Traits\Address as AddressTrait;

class AddressController extends Controller implements AddressContract
{
    use AddressTrait;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the address.
     *
     * @return Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new address.
     *
     * @return Response
     */
    public function create()
    {
        return view('address.create');
    }

    /**
     * Store a newly created address in storage.
     *
     * @return Response
     */
    public function store()
    {
        return $this->processStore();
    }

    /**
     * Display the specified address.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified address.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $routeAction = \Request::route()->getAction();
        
        $address = Address::find($id);
        return view('address.edit',compact('address','routeAction'));
    }

    /**
     * Update the specified resource in storage.
     * @return Response
     */
    public function update()
    {
        return $this->processUpdate();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        return $this->processDelete();
    }
}
