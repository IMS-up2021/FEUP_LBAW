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
}
