<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Page extends Controller
{
    public function login_page(Request $request)
    {
        $data_session = $request->session()->get('user_login');
        // if ($request->session()->exists('user_login')) {
            
        // }else{
        //     
        // }

        if (isset($data_session)) {
            return redirect() -> route('dashboard_page');
          }else{
            return view('login.login_page');
          }
        //   return redirect() -> route('login_page');
        // if ($request -> session() -> has('user_login')) {
            
        // }else{
        //     return redirect() -> route('login_page');
        // }
        
    }
    public function logout(Request $request)
    {
        $request -> session() -> flush();
        return redirect('/');
    }
}
