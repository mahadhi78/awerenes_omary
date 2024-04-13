<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Response;
use DB;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();
        $perms = [];
        $routes = Route::getRoutes();
        $recorded = 0;

        foreach ($routes as $route) {
            if (isset($route->getAction()['as'])) {
                if (!$permissions->contains('name', $route->getAction()['controller']) && $route->getAction()['prefix'] == '/system') {
                    $module = explode('.', $route->getAction()['as']);
                    $name = str_replace([".", "-", "index", "destroy", "store", "update"], ["-", "-", "list", "delete", "save", "edit"], $route->getAction()['as']);

                    // Extract the group name from the route's name
                    $groupName = explode('.', $route->getName())[0];

                    // Remove any non-alphabet characters from the group name
                    $groupName = preg_replace('/[^a-zA-Z]/', '', $groupName);

                    // Define a general format for the description here
                    $moduleWords = explode('_', $module[0]);
                    $moduleFormatted = implode(' ', array_map('ucfirst', $moduleWords));

                    // Determine the action and format the description accordingly
                    if (strpos($name, 'list') !== false) {
                        $description = $moduleFormatted . " List";
                    } elseif (strpos($name, 'edit') !== false) {
                        $description = $moduleFormatted . " Edit";
                    } elseif (strpos($name, 'save') !== false) {
                        $description = $moduleFormatted . " Save";
                    } elseif (strpos($name, 'delete') !== false) {
                        $description = $moduleFormatted . " Delete";
                    } else {
                        $description = $moduleFormatted; // Default case
                    }

                    // Replace "role" with "Role" in the description
                    $description = str_replace("role", "Role", $description);

                    // Extract the first sentence of the description
                    $groupName = strstr($description, ' ', true);

                    $perms[] = [
                        'action' => $route->getAction()['controller'],
                        'name' =>  $name,
                        'description' => $description,
                        'module' => $module[0],
                        'guard_name' => 'web',
                        'group' => $groupName, // Set the group name here
                        'created_at' => now(),
                    ];

                    $recorded++;
                }
            }
        }

        Permission::insertOrIgnore($perms);
    }

}
