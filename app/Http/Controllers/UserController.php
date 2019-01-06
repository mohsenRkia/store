<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Image;
use App\Models\Profile;
use App\Models\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function edit($id)
    {
        $profile = User::find($id)->with(['profile' => function($p){
            $p->with(['state' => function($s){
                $s->with('country:id,name');
                $s->select(["id","name","country_id"]);
            }]);
        }])->with('image')->first(["id","name","email"]);
        $countries = Country::pluck("name","id");
        $birthdate = $profile->profile->birthdate;
        if ($birthdate){
            $explode = explode(" ",$birthdate);
            $date = $explode[0];
            $date = explode("-",$date);
            $date = (object)['year' => $date[0],'month' => $date[1],'day' => $date[2]];

            return view('user.profile.index',compact(['profile','countries','date']));
        }
        return view('user.profile.index',compact(['profile','countries']));
    }

    public function update($id,Request $r)
    {
        $r->validate([
            'email' => 'required|email|string|max:255|unique:users,email,'.$id,
            'firstname' => 'nullable|string|max:100',
            'lastname' => 'nullable|string|max:100',
            'phone' => 'nullable|max:11|regex:/^[0][9][0-9]{9}/',
            'address' => 'nullable|string|max:255',
            'state' => 'nullable|numeric|min:1',
            'zipcode' => 'nullable|numeric',
            'avatar' => 'bail|nullable|dimensions:max_width:400,max_height:400,min_width:100,min_height:100|between:1,1000|mimes:jpg,png,jpeg',
            'year' => 'bail|nullable|numeric|min:1900|max:2019',
            'month' => 'bail|nullable|numeric|max:12|min:1',
            'day' => 'bail|nullable|numeric|max:31|min:1',

        ]);

        User::where('id',$id)->update(['email' => $r->email]);

        if ($r->file('avatar')){
            $file = $r->file('avatar');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $path = public_path() . "/uploads/images/avatars";
            $move = $file->move($path,$fileName);
            $isImageable = Image::where([['imageable_type','app\user'],['imageable_id',$id]])->get();
            if ($move){
                if (count($isImageable) == 1){
                    Image::where([['imageable_type','app\user'],['imageable_id',$id]])->update([
                        'url' => $fileName
                    ]);
                }else{
                    Image::create([
                        'url' => $fileName,
                        'imageable_id' => $id,
                        'imageable_type' => 'app\user'
                    ]);
                }
            }else{
                return redirect()->back();
            }
        }

        $profile = Profile::where('user_id',$id)->first();
        $profile->firstname = $r->firstname;
        $profile->lastname = $r->lastname;
        $profile->phone = $r->phone;
        $profile->address = $r->address;
        $profile->zipcode = $r->zipcode;
        $year = $r->year;
        $month = $r->month;
        $day = $r->day;
        if ($year || $month || $day){
            $r->validate([
                'year' => 'bail|required|numeric|min:1900|max:2019',
                'month' => 'bail|required|numeric|max:12|min:1',
                'day' => 'bail|required|numeric|max:31|min:1',
            ]);
            $birthdate = $year . "-" . $month . "-" . $day . " " . "00:00:00";
            $profile->birthdate = $birthdate;
        }
        if ($r->state && count(State::where('id',$r->state)->get()) == 1){
            $profile->state_id = $r->state;
        }



        if ($profile->save()){
            createAlert("Your info has updated successfully!!");
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function getstate(Request $r)
    {
        $countryId = $r->id;
        $state = State::where('country_id',$countryId)->get();
        return $state;
    }
    public function changepassword($id,Request $r)
    {
        $r->validate([
            'oldpassword' => 'required|string|min:6',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::find($id);
        $oldRq = $r->oldpassword;
        if (Hash::check($oldRq,$user->password)){
            $user->update([
                'password' => Hash::make($r->password)
            ]);
            createAlert("Your Password has been changed!!");
            return redirect()->back();
        }else{
            warningAlert("Old Password doesnt correct!!");
            return redirect()->back();
        }
    }
}
