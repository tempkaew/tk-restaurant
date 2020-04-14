<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

Use App\User;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.profile');
    }

    public function update_profile(Request $request)
    {
        $password = $request->password;

        $user = User::where('id', '=', $request->user_id)->first();

        if(Hash::check($password, $user->password)) {

            $addToDB = User::where('id', $request->user_id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'line_id' => $request->line_id,
                    'phone_number' => $request->phone_number,
                    'updated_at' => now()
                ]);

            if($addToDB) {
                return response()->json(['status'=>true,'message'=>'แก้ไขข้อมูลสำเร็จ']);
            }else{
                return response()->json(['status'=>false,'message'=>$addToDB->errors()->all()]);
            }

        } else {
            return response()->json(['status'=>false, 'message'=>'รหัสไม่ถูกต้อง']);
        }

    }

    public function update_password(Request $request)
    {
        $password = $request->password;

        $user = User::where('id', '=', $request->user_id)->first();

        if(Hash::check($password, $user->password)) {

            $addToDB = User::where('id', $request->user_id)
                ->update([
                    'password' => Hash::make($request->new_password),
                    'updated_at' => now()
                ]);

            if($addToDB) {
                return response()->json(['status'=>true,'message'=>'แก้ไขข้อมูลสำเร็จ']);
            }else{
                return response()->json(['status'=>false,'message'=>$addToDB->errors()->all()]);
            }

        } else {
            return response()->json(['status'=>false, 'message'=>'รหัสไม่ถูกต้อง']);
        }

    }

    public function update_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inputPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {

            $output = array(
                'status' => false,
                'message' => $validator->errors()->all(),
            );

        }else{

            if ($files = $request->file('inputPhoto')) {

                $input = $request->all();
                $input['inputPhoto'] = 'profile-'.$request->user_id.'.'.$request->inputPhoto->getClientOriginalExtension();
                $request->inputPhoto->move(public_path('assets/images/profile'), $input['inputPhoto']);

                $addToDB = User::where('id', $request->user_id)
                    ->update([
                        'photo' => $input['inputPhoto'],
                        'updated_at' => now()
                    ]);

                $output = array(
                    'status' => true,
                    'message' => 'ok',
                );
            }else{
                $output = array(
                    'status' => false,
                    'message' => 'error',
                );
            }

        }

        return response()->json($output);

    }

}