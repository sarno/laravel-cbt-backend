<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //index
    function index(Request $request)  {
        // $users = User::paginate(5);
        $users = DB::table('users')
        ->when($request->search, function($query) use ($request)  {
            return  $query->where('name', 'like','%'.$request->search.'%');

        })
        ->paginate(5);

        return view('pages.user.index', compact('users'));
    }

    //create
    function create() {
        return view('pages.user.create');
    }

    //store
    function store(Request $request) {
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));
        User::create($data);

        return redirect()->route('user.index')->with('success', 'Product successfully created');
    }

    //show
    function show($id) {
        return view('pages.dashboard');
    }

    //edit
    function edit($id)  {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    //update
    function update(Request $request, $id)  {
        $data = $request->all();
        $user = User::findOrFail($id);
        //cek password
        if ($request->input('passwword')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success', 'Product successfully update');
    }

    //destroy
    function destroy($id)  {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Product successfully delete');
    }
}
