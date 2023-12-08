<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function showAdministration()
    {
        return view('pages.administration');
    }

    public function showCreateTag()
    {
        $tags = Tag::all();
        return view('pages.createTag', ['tags' => $tags]);
    }
    public function showEditTag()
    {
        $tags = Tag::all();
        return view('pages.editTag', ['tags' => $tags]);
    }
    public function showEditTagForm($id)
    {
        $tag = Tag::find($id);
        return view('pages.editTagForm', ['tag' => $tag]);
    }

    public function showDeleteTag()
    {
        $tags = Tag::all();
        return view('pages.deleteTag', ['tags' => $tags]);
    }
    
    public function editTag(Request $request, $id)
    {
        //Validate the request
        $request->validate([
            'tag_name' => 'required|max:255',
        ]);

        //Find the tag
        $tag = Tag::find($id);

        //Update the tag
        $tag->tag_name = $request->tag_name;
        $tag->save();

        //Return the tag
        if($tag) {
            return redirect('administration/edit-tag?error=0');
        }
        else{ 
            return redirect('administration/edit-tag?error=1');
        }
    }
    public function createTag(Request $request)
    {
        //Validate the request
        $request->validate([
            'tag_name' => 'required|max:255',
        ]);

        //Create the tag
        $tag = Tag::create([
            'tag_name' => $request->tag_name,
        ]);

        //Return the tag
        if($tag) {
            return redirect('/administration?error=0');
        }
        else{ 
            return redirect('/administration?error=1');
        }
    }

    public function deleteTag(Request $request)
    {
        //Validate the request
        $request->validate([
            'id' => 'required',
        ]);

        //Find the tag
        $tag = Tag::find($request->id);

        //Delete the tag
        $tag->delete();

        //Return the tag
        if($tag) {
            return redirect('/administration?error=0');
        }
        else{ 
            return redirect('/administration?error=1');
        }
    }

    public function showCreateUser()
    {
        return view('pages.createUser');
    }
    public function createUser(Request $request)
    {
        //Validate the request
        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:1,2,3',
            'description' => 'required|max:255',
        ]);

        //Create the user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
            'description' => $request->description,
        ]);

        switch ($validatedData['role']) {
            case 1:
                $user->admin()->create(); 
                break;
            case 2:
                $user->moderator()->create(); 
                break;
        }
        //Return the user
        if($user) {
            return redirect('/administration?error=0');
        }
        else{ 
            return redirect('/administration?error=1');
        }
    }

    public function showEditUser()
    {
        $users = User::all();
        return view('pages.editUser', ['users' => $users]);
    }
    public function showEditUserForm($id)
    {
        $user = User::find($id);
        return view('pages.editUserForm', ['user' => $user]);
    }

    public function editUser(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|max:250',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:1,2,3',
            'description' => 'required|max:255',
        ]);

        $user = User::find($id);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($validatedData['password']);
        $user->description = $request->description;
        $user->save();

        switch ($validatedData['role']) {
            case 1:
                if(!$user->admin){
                    $user->admin()->create(); 
                }
                break;
            case 2:
                if($user->admin) {
                    $user->admin()->delete();
                }
                $user->moderator()->create(); 
                break;
            case 3:
                if($user->admin) {
                    $user->admin()->delete();
                }
                if($user->moderator) {
                    $user->moderator()->delete();
                }
        }

        if($user) {
            return redirect('administration/edit-user?error=0');
        }
        else{ 
            return redirect('administration/edit-user?error=1');
        }
    }

    public function showDeleteUser()
    {
        $users = User::all();
        return view('pages.deleteUser', ['users' => $users]);
    }

    public function deleteUser(Request $request)
    {
        //Validate the request
        $request->validate([
            'id' => 'required',
        ]);

        //Find the user
        $user = User::find($request->id);

        //Delete the user
        $user->delete();

        //Return the user
        if($user) {
            return redirect('/administration?error=0');
        }
        else{ 
            return redirect('/administration?error=1');
        }
    }

    public function showSearchUser()
    {
        $users = User::all();
        return view('pages.searchUser', ['users' => $users]);
    }

    public function searchUser(Request $request)
    {
        //Validate the request
        $request->validate([
            'search' => 'required|max:255',
        ]);

        //Find the user
        $users = User::where('username', 'ILIKE', '%' . $request->search . '%')->get();

        //Return the user
        if($users) {
            return view('pages.searchUserResult', ['users' => $users]);
        }
        else{ 
            return redirect('/administration/search-user?error=1');
        }
    }

    public function showBlockUser()
    {
        $users = User::all();
        return view('pages.blockUser', ['users' => $users]);
    }

    public function blockUser(Request $request, $id)
    {
        //Validate the request
        $request->validate([
            'blocked' => 'required|in:0,1',
        ]);

        //Find the user
        $user = User::find($id);

        //Block the user
        $user->blocked = $request->blocked;
        $user->save();

        //Return the user
        if($user) {
            return redirect('administration/block-user?error=0');
        }
        else{ 
            return redirect('administration/block-user?error=1');
        }
    }
}
