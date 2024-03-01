<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Siswa extends Controller
{
    public function index(){
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed to get user information

            // dd(User::where('id', Auth::user()->id)->get());
            return view('akun.index', [
                'akunn' => User::where('id', Auth::user()->id)->get(),
                'title' => 'Akun'
            ]);
        } else {
            // User is not authenticated, handle accordingly (redirect, show login page, etc.)
            return redirect()->route('login'); // Adjust the route as per your application's needs
        }
    }
    public function updatee (Request $request,User $id){

      $user = User::find($id);

      if($request->password == null){
      $user->update($request->except(['_token', '_method']));
      return redirect()->to(url('akun'))->with(['dataEdit' => true]);
      }
      $user = User::find($id);

      if($request->password == null){
      $user->update($request->except(['_token', '_method']));
      return redirect()->to(url('akun'))->with(['dataEdit' => true]);
      

        
  }
  }
  public function editt (User $id){
    $data = [ 
        'title' => 'Spp | MyApp',
        'active' => 'Akun',
        'User' => $id
    ];
}

}