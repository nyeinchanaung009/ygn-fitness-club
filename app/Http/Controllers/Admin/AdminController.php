<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Member;
use App\Models\Membership;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function home(){
        $members = [];
        if(request('qsearch')){
            $members = Member::where('name','LIKE','%'.request('qsearch').'%')->orWhere('id',request('qsearch'))->with('branch')->get();
        }

        $nextSevenDay = Carbon::now()->addDays(7)->format('Y-m-d');
        $now = Carbon::now()->addDays(1)->format('Y-m-d');
        $datas = Membership::whereBetween('plan_expire_date',[$now,$nextSevenDay])->with('member','plan')->paginate(6);

        $today = Carbon::now()->format('Y-m-d');
        $branchCount = Branch::count();
        $memberCount = Member::count();
        $activeCount = Membership::where('plan_expire_date','>',$today)->count();       
        $expireCount = Membership::where('plan_expire_date','<=',$today)->count();   
        return view('index',compact('members','datas','branchCount','memberCount','activeCount','expireCount'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::with('branch')->paginate(7);
        return view('admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::get();
        return view('admin.create',compact('branches'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'phone' => 'string',
            'branch_id' => 'required|integer'
        ]);

        $name = filter_var($request->name,FILTER_SANITIZE_STRING);
        $email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
        $password = filter_var($request->password,FILTER_SANITIZE_STRING);
        $phone = filter_var($request->phone,FILTER_SANITIZE_STRING);
        $branch_id = filter_var($request->branch_id,FILTER_SANITIZE_NUMBER_INT);

        try{
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'phone' => $phone,
                'image' => null,
                'branch_id' => $branch_id,
            ]);
        }catch(Exception $e){
            return back()->with('error','Fail to create admin')->withInput();
        }

        return redirect()->route('admin.index')->with('msg',['type' => 'success','text' => 'Admin create success']);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {   
        $branch = Branch::find($admin->branch_id);
        if($admin->id == Auth::user()->id){
            return view('admin.profile',compact('admin','branch'));
        }

        return back();

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        if(Auth::user()->id == $admin->id){
            $branches = Branch::get();
            return view('admin.update',compact('admin','branches'));
        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'branch_id' => 'required|integer'
        ]);

        $name = filter_var($request->name,FILTER_SANITIZE_STRING);
        $email = filter_var($request->email,FILTER_SANITIZE_EMAIL);
        $branch_id = filter_var($request->branch_id,FILTER_SANITIZE_NUMBER_INT);

        $phone = '';
        if($request->phone != null){
            $phone = filter_var($request->phone,FILTER_SANITIZE_STRING);
        }

        if($request->password != null){
            $password = Hash::make(filter_var($request->password,FILTER_SANITIZE_STRING));
        }else{
            $user = User::where('id',$id)->first();
            $password = $user->password;
        }
        
        $admin = User::find($id);

        if($request->file('image') != null){
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path('/images/adminProfile'),$filename);

            $image = '/images/adminProfile/'.$filename;

            File::delete(public_path($admin->image));
        }else{
            $image = $admin->image;
        }

        try{
            User::where('id',$id)->update([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'image' => $image,
                'phone' => $phone,
                'branch_id' => $branch_id,
            ]);
        }catch(Exception $e){
            return back()->with('error','Fail to update admin profile')->withInput();
        }

        return redirect()->route('admin.index')->with('msg',['type' => 'success','text' => 'Admin update success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id == Auth::user()->id){
            User::find($id)->delete();
            Auth::logout();
            return redirect()->route('loginview');
        }else{
            return back();
        }
    }
}
