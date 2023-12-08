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
        $this->authorize('showAdministration', User::class);

        return view('pages.administration');
    }

    public function showCreateTag()
    {
        $this->authorize('showAdministration', User::class);

        $tags = Tag::all();
        return view('pages.createTag', ['tags' => $tags]);
    }
    public function showEditTag()
    {
        $this->authorize('showAdministration', User::class);

        $tags = Tag::all();
        return view('pages.editTag', ['tags' => $tags]);
    }
    public function showEditTagForm($id)
    {
        $this->authorize('showAdministration', User::class);

        $tag = Tag::find($id);
        return view('pages.editTagForm', ['tag' => $tag]);
    }

    public function showDeleteTag()
    {
        $this->authorize('showAdministration', User::class);

        $tags = Tag::all();
        return view('pages.deleteTag', ['tags' => $tags]);
    }
    
    public function editTag(Request $request, $id)
    {

        $this->authorize('showAdministration', User::class);

        $request->validate([
            'tag_name' => 'required|max:255',
        ]);

        $tag = Tag::find($id);

        $tag->tag_name = $request->tag_name;
        $tag->save();

        if($tag) {
            return redirect('administration/edit-tag?error=0');
        }
        else{ 
            return redirect('administration/edit-tag?error=1');
        }
    }
    public function createTag(Request $request)
    {
        $this->authorize('showAdministration', User::class);

        $request->validate([
            'tag_name' => 'required|max:255',
        ]);

        $tag = Tag::create([
            'tag_name' => $request->tag_name,
        ]);

        if($tag) {
            return redirect('/administration?error=0');
        }
        else{ 
            return redirect('/administration?error=1');
        }
    }

    public function deleteTag(Request $request)
    {

        $this->authorize('showAdministration', User::class);

        $request->validate([
            'id' => 'required',
        ]);

        $tag = Tag::find($request->id);

        $tag->delete();

        if($tag) {
            return redirect('/administration?error=0');
        }
        else{ 
            return redirect('/administration?error=1');
        }
    }

    public function showCreateUser()
    {
        $this->authorize('showAdministration', User::class);

        return view('pages.createUser');
    }
    public function createUser(Request $request)
    {
        $this->authorize('showAdministration', User::class);

        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:1,2,3',
            'description' => 'required|max:255',
        ]);

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
        $this->authorize('showAdministration', User::class);

        $users = User::all();
        return view('pages.editUser', ['users' => $users]);
    }
    public function showEditUserForm($id)
    {
        $this->authorize('showAdministration', User::class);

        $user = User::find($id);
        return view('pages.editUserForm', ['user' => $user]);
    }

    public function editUser(Request $request, $id)
    {
        $this->authorize('showAdministration', User::class);

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
        $this->authorize('showAdministration', User::class);

        $users = User::all();
        return view('pages.deleteUser', ['users' => $users]);
    }

    public function deleteUser(Request $request)
    {
        $this->authorize('showAdministration', User::class);

        $request->validate([
            'id' => 'required',
        ]);

        $user = User::find($request->id);

        $user->delete();

        if($user) {
            return redirect('/administration?error=0');
        }
        else{ 
            return redirect('/administration?error=1');
        }
    }

    public function showSearchUser()
    {
        $this->authorize('showAdministration', User::class);

        $users = User::all();
        return view('pages.searchUser', ['users' => $users]);
    }

    public function searchUser(Request $request)
    {
        $this->authorize('showAdministration', User::class);

        $request->validate([
            'search' => 'required|max:255',
        ]);

        $users = User::where('username', 'ILIKE', '%' . $request->search . '%')->get();

        if($users) {
            return view('pages.searchUserResult', ['users' => $users]);
        }
        else{ 
            return redirect('/administration/search-user?error=1');
        }
    }

    public function showBlockUser()
    {
        $this->authorize('showAdministration', User::class);

        $users = User::all();
        return view('pages.blockUser', ['users' => $users]);
    }

    public function blockUser(Request $request, $id)
    {
        $this->authorize('showAdministration', User::class);

        $request->validate([
            'blocked' => 'required|in:0,1',
        ]);

        $user = User::find($id);

        $user->blocked = $request->blocked;
        $user->save();

        if($user) {
            return redirect('administration/block-user?error=0');
        }
        else{ 
            return redirect('administration/block-user?error=1');
        }
    }
}
