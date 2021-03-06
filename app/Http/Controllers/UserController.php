<?php

namespace App\Http\Controllers;

use App\Comment;
<<<<<<< HEAD
use App\Contact;
=======
>>>>>>> d9412d38df9a940c44f53010f15071eaf6780ef1
use App\Http\Requests\UserFormRequest;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.

     ** @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
        $articles=Post::where('author_id',Auth::user()->id)->paginate(5);
        $count=Post::where('author_id',Auth::user()->id)->count();
        $comments=Comment::where('user_id',Auth::user()->id);
        $messages=Contact::whereEmail(Auth::user()->email);
        return view('auth.profile',compact('articles','comments','messages','count'));
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    return view('auth.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $User)
    {
         if($request->image==''){
            $paths=$request->avatar;
        }else{
                 // Save image
            $path = Storage::disk('images')->put('', $request->file('image'));

            $paths="users/".$path;
         }

         if($request->password !=""){
            $password= bcrypt($request->password);
            $User->update([
                'password'=> $password
            ]);
            }
            
        $User->update([
        'name'=>$request->name,
        'username'=>$request->username,
        'email'=>$request->email,
        'contact'=>$request->telephone,
        'avatar'=>$paths,
        'city'=>$request->city,
        ]);
        flashy('Profil mise a jour avec succès');
        return redirect('/User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        Comment::where('name', auth::user()->username)
        ->update([
           'user_id'=>null
        ]);
        $User->delete();
<<<<<<< HEAD
        return redirect()->route('home');
=======
        return redirect('/');
>>>>>>> d9412d38df9a940c44f53010f15071eaf6780ef1
    }
}
