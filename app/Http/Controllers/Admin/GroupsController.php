<?php namespace App\Http\Controllers\Admin;

use Sentinel;
use View;
use Validator;
use Input;
use Redirect;
use Lang;
use URL;
use App\Http\Utilities\PermissionsListManager as PermissionsListManager;

class GroupsController extends BaseController
{
    /**
     * Show a list of all the groups.
     *
     * @return View
     */
    public function getIndex()
    {
        // Grab all the groups
        $roles = Sentinel::getRoleRepository()->all();
        // Show the page
        return View('admin/groups/index', compact('roles'));
    }

    /**
     * Group create.
     *
     * @return View
     */
    public function getCreate()
    {
        $permissions = PermissionsListManager::getAllPermissions();
        // Show the page
        return View('admin/groups/create', compact('permissions'));
    }

    /**
     * Group create form processing.
     *
     * @return Redirect
     */
    public function postCreate()
    {
        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required',
            'slug' => 'required|unique:roles',
            'permissions' => 'required',
        );

        //manually add slug to Input array for validation
        Input::merge(array('slug' => str_slug(Input::get('name'))));

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $allPermissions = Input::get('permissions');

        $permissions = $this->preparePermissionArray($allPermissions);
        
        if ($role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => Input::get('name'),
            'slug' => str_slug(Input::get('name')),
            'permissions' => $permissions
        ])) {
            // Redirect to the new group page
            return Redirect::route('groups')->with('success', Lang::get('groups/message.success.create'));
        }

        // Redirect to the group create page
        return Redirect::route('create/group')->withInput()->with('error', Lang::get('groups/message.error.create'));
    }

    /**
     * Group update.
     *
     * @param  int  $id
     * @return View
     */
    public function getEdit($id = null)
    {
        try {
            // Get the group information
            $role = Sentinel::findRoleById($id);
        } catch (GroupNotFoundException $e) {
            // Redirect to the groups management page
            return Redirect::route('groups')->with('error', Lang::get('groups/message.group_not_found', compact('id')));
        }

        $permissions = PermissionsListManager::getAllPermissions();
        // Show the page
        return View('admin/groups/edit', compact('role', 'permissions'));
    }

    /**
     * Group update form processing page.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function postEdit($id = null)
    {
        try {
            // Get the group information
            $group = Sentinel::findRoleById($id);
        } catch (GroupNotFoundException $e) {
            // Redirect to the groups management page
            return Rediret::route('groups')->with('error', Lang::get('groups/message.group_not_found', compact('id')));
        }

        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required',
            'permissions' =>'required'
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        // Update the group data
        $group->name        = Input::get('name');
        $group->permissions   =  $this->preparePermissionArray(Input::get('permissions'));

        // Was the group updated?
        if ($group->save()) {
            // Redirect to the group page
            return Redirect::route('groups')->with('success', Lang::get('groups/message.success.update'));
        } else {
            // Redirect to the group page
            return Redirect::route('update/group', $id)->with('error', Lang::get('groups/message.error.update'));
        }
    }

    /**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'groups';
        $confirm_route = $error = null;
        try {
            // Get group information
            $role = Sentinel::findRoleById($id);


            $confirm_route =  route('delete/group', ['id'=>$role->id]);
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        } catch (GroupNotFoundException $e) {
            $error = Lang::get('admin/groups/message.group_not_found', compact('id'));
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
    }

    /**
     * Delete the given group.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function getDelete($id = null)
    {
        try {
            // Get group information
            $role = Sentinel::findRoleById($id);

            // Delete the group
            $role->delete();

            // Redirect to the group management page
            return Redirect::route('groups')->with('success', Lang::get('groups/message.success.delete'));
        } catch (GroupNotFoundException $e) {
            // Redirect to the group management page
            return Redirect::route('groups')->with('error', Lang::get('groups/message.group_not_found', compact('id')));
        }
    }

    private function preparePermissionArray($permissions)
    {
        $result = [];

        foreach ($permissions as $key => $value) {
            $result[$value] = true;
        }
        return $result;
    }
}
