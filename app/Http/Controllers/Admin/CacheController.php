<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\BaseController;

class CacheController extends BaseController
{
    public function flushAllCache()
    {
    	Cache::flush();
    	// dd('cache flushed successfully');
    	return Redirect::to(route('dashboard'));
    }
}
