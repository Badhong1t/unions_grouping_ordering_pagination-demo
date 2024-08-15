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

        /* $userQuery = DB::table('users')
            ->select('name')->where('active', 1);

        $adminQuery = DB::table('admins')
            ->select('name')->where('active', 0);

        $customerQuery = DB::table('customers')
            ->select('name')->where('active', 0);

        $unionQuery = $userQuery->union($adminQuery)->union($customerQuery);

        $result = $unionQuery->orderBy('name')->get(); */

        //Demo of ordering with query builder

        //simple orderby

        // $users = DB::table('users')->orderBy('name', 'asc');

        //Ordering with multiple column

        /* $users = DB::table('users')
                 ->orderBy('name', 'asc')->orderBy('age', 'desc');

        $result = $users->get(); */

        //Using raw expressions

        /*$users = DB::table('users')
                ->orderByRaw('LENGTH(name) DESC');

        $result = $users->get();*/

        //Conditional ordering

        /*$sortBy = 'name';
        $sortOrder = 'asc';

        $users = DB::table('users')
                ->when($sortBy, function ($query, $sortBy) use ($sortOrder) {

                    return $query->orderBy($sortBy, $sortOrder);

                });

        $result = $users->get();*/

        //Combining orderBy with where and limit

        /*$admins = DB::table('admins')
                ->where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->limit(4);

        $result = $admins->get();*/

        //Advanced ordering with subqueries

        /*$users = DB::table('posts')
                ->select('posts.*','comment_counts.comment as comment_count')
                ->leftJoin(DB::raw('( select post_id, COUNT(*) comment FROM comments GROUP BY post_id ) as comment_counts'), 'posts.id', '=', 'comment_counts.post_id')
                ->orderBy('comment_counts.comment', 'desc');

        $result = $users->get();*/

        //Laravel grouping

        //Basic grouping in query builder

        /*$users = DB::table('admins')
                ->where('status', 'active')
                ->where(function ($query) {

                    $query->where('age', '>', '30')
                        ->orWhere('role', 'admin');

                });

        $result = $users->get();*/

        //Intermediate grouping with aggregate function

        /*$orders = DB::table('orders')
                ->select(DB::raw('customer_id, COUNT(*) as total_orders'))
                ->where('status','processing')
                ->groupBy('customer_id')
                ->having(DB::raw('COUNT(*)'), '>', 5);

        $result = $orders->get();*/

        //Advanced grouping with nested conditions

        /*$products = DB::table('products')
                ->where(function ($query){

                    $query->where('category_id', 3)
                          ->where(function ($query){

                              $query->where('price', '>', '1000')
                                    ->orWhere('discount', '>', '20');

                          });

                })

                ->orWhere(function ($query){

                    $query->where('category_id', 4)
                          ->where('price', '<', '1000');

                });

        $result = $products->get();*/

        //PAGINATION

        //Basic pagination example

        /*$profiles = DB::table('profiles');

        $result = $profiles->paginate(5);*/

        //Pagination with filtering

        /*$profiles = DB::table('profiles')
                ->where('city', 'Dhaka')
                ->orderBy('id','asc');

        $result = $profiles->paginate(5);*/

        //Pagination with multiple joins and select

        /*$users = DB::table('users')
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->select('users.*', 'profiles.firstName', 'profiles.city', 'profiles.mobile', 'roles.name as role_name')
                ->where('users.active', 1);

        $result = $users->paginate(1);*/

        //Advanced pagination with grouping and aggregation

        /*$posts = DB::table('posts')
                ->join('comments', 'posts.id', '=', 'comments.post_id')
                ->select('posts.title', DB::raw('COUNT(comments.post_id) as comment_count'))
                ->groupBy('posts.title')
                ->orderBy('comment_count', 'desc');

        $result = $posts->paginate(2);*/

        //Customizing pagination links

        /*$users = DB::table('users')
                ->paginate(5);

        $result = $users->withPath('/query');*/

        //Custom pagination with additional parameters

        /*$result = DB::table('products')
                ->paginate(

                    $perpage = 5, //number of items per page
                    $columns = ['*'], //columns to select, default to all columns
                    $pagename = 'items' //name of the page query parameter

                );*/

        //Pagination with custom query string

        /*$result = DB::table('products')
                ->where('remark', 'new')
                ->paginate(5)
                ->appends([

                    'sort' => 'price',
                    'order' => 'asc'

                ]);*/

        //Pagination with sorting by latest or oldest

        $latestResult = DB::table('product_carts')
                        ->latest()
                        ->paginate(5);

        $oldestResult = DB::table('product_carts')
                        ->oldest()
                        ->paginate(5);

        $result = $latestResult->union($oldestResult);

        return $result;

    }
}
