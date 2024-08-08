<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class queryController extends Controller
{


    function index(){

        //demo of unions

        /*$firstQuery = DB::table('users')
            ->select('name','email');

        $secondQuery = DB::table('admins')
            ->select('name','email');

        $result = $firstQuery->union($secondQuery)->get();*/

        //demo of unionAll

        /*$userQuery = DB::table('users')
            ->select('name');

        $adminQuery = DB::table('admins')
            ->select('name');

        $unionAllQuery = $userQuery->unionAll($adminQuery);

        $result = $unionAllQuery->get();*/

        //demo of combining more than two queries using union

        /*$userQuery = DB::table('users')
            ->select('name');

        $adminQuery = DB::table('admins')
            ->select('name');

        $customerQuery = DB::table('customers')
            ->select('name');

        $unionQuery = $userQuery->unionAll($adminQuery)->unionAll($customerQuery);

        $result = $unionQuery->get();*/

        //practical example with ordering and filtering with union

        $userQuery = DB::table('users')
            ->select('name')->where('active', 1);

        $adminQuery = DB::table('admins')
            ->select('name')->where('active', 0);

        $customerQuery = DB::table('customers')
            ->select('name')->where('active', 0);

        $unionQuery = $userQuery->union($adminQuery)->union($customerQuery);

        $result = $unionQuery->orderBy('name')->get();

        return $result;

    }
}
