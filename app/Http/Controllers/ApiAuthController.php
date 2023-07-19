<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register_admin(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:100",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6|confirmed",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "msg" => $validator->errors()
            ], 301);
        }
        //hash
        $request->password = bcrypt($request->password);
        //create
        $access_token = Str::random(64);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
            "access_token" => $access_token,
        ]);
        return response()->json([
            "msg" => "تم انشاء الحساب بنجاح",
            "access_token" => $access_token,
        ], 201);
    }
    public function login_admin(Request $request)
    {
        $access_token = Str::random(64);

        //validation
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|string|min:6",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "msg" => $validator->errors()
            ], 301);
        }
        //check  --email --password
        $user = User::where("email", "=", $request->email)->first(); //عشان لو مش يونيك
        if ($user != null) {
            // check pasword
            $password_checked = Hash::check($request->password, $user->password);
            if ($password_checked) {
                //update access token
                $user->update([
                    "access_token" => $access_token
                ]);
            } else {
                return response()->json([
                    "msg" => "البيانات التي ادخلتها غير صحيحة"
                ], 301);
            }
        } else {
            return response()->json([
                "msg" => "البيانات التي ادخلتها غير موجودة"
            ], 301);
        }
        return response()->json([
            "msg" => "تم تسجيل الدخول بنجاح",
            "access_token" => $access_token
        ], 201);
    }
    public function logout_admin(Request $request)
    {
        $access_token = $request->header("access_token");
        if ($access_token != null) {
            $user = User::where("access_token", "=", $access_token)->first();
            if ($user != null) {
                $user->update([
                    "access_token" => null
                ]);
                return response()->json([
                    "msg" => "تم تسجيل الخروج بنجاح",
                ], 200);
            } else {
                return response()->json([
                    "msg" => "access_token is not correct"
                ], 300);
            }
        } else {
            return response()->json([
                "msg" => "access_token is not found",
            ], 301);
        }
    }
    public function login_student(Request $request)
    {
        $access_token = Str::random(64);

        //validation
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|string|min:6",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "msg" => $validator->errors()
            ], 301);
        }
        //check  --email --password
        $student = Student::where("email", "=", $request->email)->first(); //عشان لو مش يونيك
        if ($student != null) {
            // check pasword
            $password_checked = Hash::check($request->password, $student->password);
            if ($password_checked) {
                //update access token
                $student->update([
                    "access_token" => $access_token
                ]);
            } else {
                return response()->json([
                    "msg" => "البيانات التي ادخلتها غير صحيحة"
                ], 301);
            }
        } else {
            return response()->json([
                "msg" => "البيانات التي ادخلتها غير موجودة"
            ], 301);
        }
        return response()->json([
            "msg" => "تم تسجيل دخول الطالب بنجاح",
            "access_token" => $access_token
        ], 201);
    }
    public function logout_student(Request $request)
    {
        $access_token = $request->header("access_token");
        if ($access_token != null) {
            $student = Student::where("access_token", "=", $access_token)->first();
            if ($student != null) {
                $student->update([
                    "access_token" => null
                ]);
                return response()->json([
                    "msg" => "تم تسجيل الخروج بنجاح",
                ], 200);
            } else {
                return response()->json([
                    "msg" => "access_token not correct"
                ], 300);
            }
        } else {
            return response()->json([
                "msg" => "access_token is not found",
            ], 301);
        }
    }
}
