<?php

namespace App\Http\Controllers;

use Auth;
use Zizaco\Entrust\Entrust;

class PageController extends Controller {

    public function user() {
        if (!Auth::check()) {
            return redirect('/');
        }

        if (!Auth::user()->hasRole('user')) {
            return redirect('/');
        }
        return view('page.user');
    }
    public function usersetting() {
        if (!Auth::check()) {
            return redirect('/');
        }

        if (!Auth::user()->hasRole('user')) {
            return redirect('/');
        }
        return view('page.usersetting');
    }

    public function admin() {
        if (!Auth::check()) {
            return redirect('/');
        }
        if (!Auth::user()->hasRole('admin')) {
            return redirect('/');
        }
        return view('page.admin');
    }

    public function manager() {
        if (!Auth::check()) {
            return redirect('/');
        }
        if (!Auth::user()->hasRole('manager') && !Auth::user()->hasRole('admin')) {
            return redirect('/');
        }
        return view('page.manager');
    }

}
