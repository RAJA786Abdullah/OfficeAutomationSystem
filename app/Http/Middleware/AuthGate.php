<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class AuthGate
{
	public function handle($request, Closure $next)
	{
		$user = \Auth::user();
		
		$rawSQL = "
			SELECT LOWER(CONCAT_WS('_',privilege.privilegeCode,accessLevel.accessLevel)) AS permission
			FROM userRole
			INNER JOIN rolePrivilege ON rolePrivilege.roleID = userRole.roleID
			INNER JOIN privilege ON privilege.privilegeID = rolePrivilege.privilegeID
			INNER JOIN accessLevel ON accessLevel.accessLevelID = privilege.accessLevelID
			WHERE userRole.userID = ";
		if (!app()->runningInConsole() && $user) {
			$rawSQL .= $user->userID;
			$userPermissions = DB::select($rawSQL);
			
			
			foreach ($userPermissions as $permission) {
				Gate::define($permission->permission, function () {
					return true;
				});
			}
			
			// Settings stuff
			// \App\Services\SettingService::initializeSettings();
		}
		return $next($request);
	}
}
