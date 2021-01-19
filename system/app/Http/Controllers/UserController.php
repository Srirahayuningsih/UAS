<?php 

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserDetail;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller {
	function index(){
		$data['list_user'] = User::withCount('produk')->get();

		// $user = request()->user();
		// dd($user);

		return view ('user.index', $data);

	}

	function create(){
		return view ('user.create');

	}

	//Cara Membuat Form Validation (2)
	function store(UserStoreRequest $request){

		//Cara Membuat Form Validation (1) menggunakan Array
		//$validated = request()->validate([
			//'nama' => ['required'],
			//'username' => ['required'],
			//'email' => ['required']
		//]);

		$user = new User;
		$user->nama = request('nama');
		$user->username = request('username');
		$user->email = request('email');
		$user->password = bcrypt(request('password'));
		$user->save();

		$userDetail = new UserDetail;
		$userDetail->id_user = $user->id;
		$userDetail->no_handphone = request ('no_handphone');
		$userDetail->save();

		return redirect('admin/user')->with('success', 'Data Berhasil Ditambahkan');

	}

	function show(User $user){
		//function show($user){
		//FindOrFile
		//$user = User::findOrFail($user);
		//$user = User::find($user);
		$loggedUser = request()->user();
		//($loggedUser->id != $user->id) return abort(403);
		if($loggedUser->id != $user->id) return abort(404);
		//if($loggedUser->id != $user->id) return abort(500);
		//dd($user, $loggedUser);
		$data['user'] = $user;
		return view('user.show', $data);
		
	}

	function edit(User $user){
		$data['user'] = $user;
		return view('user.edit', $data);
		
	}

	function update(User $user){
		$user->nama = request('nama');
		$user->username = request('username');
		$user->email = request('email');
		if(request('password')) $user->password = bcrypt(request('password'));
		$user->save();


		return redirect('admin/user')->with('warning', 'Data Berhasil Diedit');
		
	}

	function destroy(User $user){
		$user->delete();


		return redirect('admin/user')->with('danger', 'Data Berhasil Dihapus');
	}

 }