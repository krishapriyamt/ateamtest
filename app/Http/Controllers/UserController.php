<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use App\User;
use App\Friend_list;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List Classes.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = auth()->user()->id;

        $getrequestlist =Friend_list:: where('friend_id', $id)->where('status', '0') ->pluck('user_id')->toArray();
        $sentrequestlist =Friend_list:: where('user_id', $id)->where('status', '0') ->pluck('friend_id')->toArray();
        $frndlist1 =Friend_list:: where('user_id', $id)->where('status', '1') ->pluck('friend_id');
        $frndlist2 =Friend_list:: where('friend_id', $id)->where('status', '1') ->pluck('user_id');
        // $myfriends = array_merge($frndlist1,$frndlist2);
         $myfriends = $frndlist1->merge($frndlist2);
         $myfriends = $myfriends->toArray();
        $users =User::where('id','!=',$id)->get();

        return view('modules/user/user_list', compact('users','getrequestlist','sentrequestlist','myfriends'));
    }

    public function friendRequest()
    {
        $friend_id = $_POST['friend_id'] ;
        $status = $_POST['status'] ;

        $result = Friend_list::insertGetId([
            'user_id' => auth()->user()->id,
            'friend_id' => $friend_id,
            'status' => $status
        ]);
        if($result){
            echo 'success';
        }

    }

    public function getfriendrequest(){
        $id = auth()->user()->id;
        $frndlist =Friend_list::with('User')->where('friend_id', $id)-> where('status', '0')->get();
        return view('modules/user/friend_request', compact('frndlist'));
    }

    public function sendrequestlist(){
        $id = auth()->user()->id;
        $frndlist =Friend_list::with('Friend')->where('user_id', $id)-> where('status', '0')->get();
        return view('modules/user/sendrequestlist', compact('frndlist'));
    }

    public function acceptFriendRequest(){

        $fid = $_POST['id'] ;
        $status = $_POST['status'] ;
        $id = auth()->user()->id;

        $result = Friend_list::where('friend_id',$id)->where('user_id',$fid)->update(['status'=>$status]);

        if($result){
            echo 'success';
        }

    }
    public function myFriends(){
        $id = auth()->user()->id;
        $friends = [];
        $frndlist1 =Friend_list::where('user_id', $id)->where('status', '1') ->pluck('friend_id');
        $frndlist2 =Friend_list::where('friend_id', $id)->where('status', '1') ->pluck('user_id');
        $frndlist = $frndlist1->merge($frndlist2);
        $frndlist = $frndlist->toArray();
        $friends = User::whereIn('id', $frndlist)->get();
        return view('modules/user/myfriends', compact('friends'));

    }

    public function profileEdit(){
        $id = auth()->user()->id;
        $viewdata = User::where('id',$id)->get();
        return view('modules/user/profile_edit', compact('viewdata'));
    }

    public function update(Request $request)
    { 
        $validator = Validator::make($request->all(),
		[
		    'name' => 'required',
            'email' => 'required|email',
            // 'password' => 'required',
            // 'profile_image' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $userid =  $request->userid;
            $name =  $request->name;
            $email = $request->email;
            $gender = $request->gender;
            $old_image = $request->old_image;
            $old_image_extn = explode('.',$old_image);
            $file = $request->file('profile_image');
            if(empty($file)){
                $result = User::where('id',$userid)->update(['name'=>$name,'email'=>$email,'gender'=>$gender]);
            }else{
                $filextnsn = $file->getClientOriginalExtension();
                $forginalname = rand(101,1000).'.'.$filextnsn;
                    /** delete image **/
                $deleteimage = '/profileImage/userphoto'.$userid. '.' . $old_image_extn[1];
                \Storage::disk('public')->delete($deleteimage);
                $result = User::where('id',$userid)->update(['name'=>$name,'email'=>$email,'gender'=>$gender,'profile_image' => $forginalname,]);
                $filename = '/profileImage/userphoto'.$userid. '.' . $file->getClientOriginalExtension();
                if(!empty($result)){
                    /* Image Store In Storage **/
                    $src = file_get_contents($file);
                    \Storage::disk('public')->put($filename, $src);
                }
            }
            if($result){
                return redirect('profile_edit')->with('success','Successfully Updated');
            }else{
                return redirect('profile_edit')->with('danger','Error in Update');
            }
        }
    }
}
