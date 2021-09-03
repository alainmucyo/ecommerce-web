<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResource;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function imageUploader($image): string
    {
        $uploadedFileUrl = Cloudinary()->upload($image)->getSecurePath();
        return $uploadedFileUrl;
    }

    public function users()
    {
        $auth = auth()->user();
        return view("admin.users.index", compact("auth"));
    }

    public function sellers()
    {
        $sellers = Role::where("slug", "seller")->first()->users->where("disabled", 0)->where("confirmed", 0)->where("status", 0);
        return view("admin.users.sellers", compact('sellers'));
    }

    public function sellersList()
    {
//        return Role::where("slug","seller")->first()->users;
        $sellers = Role::where("slug", "seller")->first()->users->where("confirmed", 1);
        return view("admin.users.sellers_list", compact('sellers'));
    }

    public function sellerDisable(User $user)
    {
        $user->update(['disabled' => true, "status" => 0]);
        Product::where("seller_id", $user->id)->update(["status" => 0]);
        return redirect()->back()->with("success", "Seller and his/her products disabled successfully!");
    }

    public function sellerEnable(User $user)
    {
        $user->update(['disabled' => false, "status" => 1]);
        Product::where("seller_id", $user->id)->update(["status" => 1]);
        return redirect()->back()->with("success", "Seller and his/her products enabled successfully!");
    }

    public function index()
    {
        return response(UsersResource::collection(User::latest()->where("status", 1)->get()));
    }

    public function acceptSeller(User $user)
    {
        $user->update(['status' => 1, 'confirmed' => 1]);
        return redirect()->back()->with("success", "Seller accepted successfully!");
    }

    public function rejectSeller(User $user)
    {
        $user->forceDelete();
        return redirect()->back()->with("success", "Seller rejected successfully!");
    }

    public function addOnHomepage(Request $request, User $user)
    {
        if ($request->submit == "add")
            $user->update(["on_homepage" => true]);
        else {
            Product::where("seller_id", $user->id)->update(["home_section_id" => null]);
            $user->update(["on_homepage" => false]);
        }
        return redirect()->back()->with("success", "Seller updated successfully!");
    }

    public function store(Request $request)

    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'role_id' => "required"
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make('password'),
        ]);
        $role = Role::find($request['role_id']);
        $user->attachRole($role);
        return response(new UsersResource($user));
    }


    public function show(User $user)
    {
        return $user;
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => ['required', 'string', 'max:255', 'unique:users,email,' . $user->id],
            "role_id" => "required"
        ]);
        $user->update([
            'email' => $request['email'],
        ]);
        $user->detachAllRoles();
        $role = Role::find($request['role_id']);
        $user->attachRole($role);
        return response(new UsersResource($user));
    }

    public function destroy(User $user)
    {
        $user->detachAllRoles();
        $user->delete();
    }

    public function getProfile()
    {
        return view("seller.profile");
    }

    public function getCustomerProfile()
    {
        if (auth()->check() && (auth()->user()->hasrole("admin") || auth()->user()->hasrole("seller"))) {
            return redirect("/profile");
        }
        return view("home.profile");
    }

    public function profile(Request $request, User $user)
    {
        $validators = validator()->make($request->all(), [
            'address' => ['required', 'max:255'],
            'phone' => 'required',
        ]);
        if ($validators->fails()) {
            return response()->json($validators->errors(), 422);
        }
        if ($request->old_password && trim($request->old_password) != "") {

            $old_password = $user->getAuthPassword();
            if (password_verify($request->old_password, $old_password)) {
                $validators = validator()->make($request->all(), [
                    "password" => "required|confirmed"
                ]);
                if ($validators->fails()) {
                    return response()->json($validators->errors(), 422);
                }
                $user->update(["password" => Hash::make($request->password)]);
            } else {
                return response()->json(["old_password" => "Wrong Password"], 400);

            }
        }
        if ($request["avatar"] !== $user->avatar) {
            $request["avatar"] = $this->imageUploader($request->avatar);
        }
        $user->update(["address" => $request->address, "avatar" => $request->avatar, "email" => $request->email, "phone" => $request->phone]);


        return $user;

    }

    public function details()
    {
        return User::where("id", auth()->user()->id)->first();
    }

}
