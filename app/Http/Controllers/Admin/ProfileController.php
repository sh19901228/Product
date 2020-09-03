<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Profilehistory;
use Carbon\Carbon;
class ProfileController extends Controller
{
    //
    public function add()
    {
      // admin/profileディレクトリ配下のcreate.blade.phpファイルを呼び出す
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();
      
      unset($form['_token']);
      
      $profile->fill($form);
      $profile->save();
      
      return redirect('admin/profile/create');
    }
    
    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $profiles = Profile::where('name', $cond_title)->get();
      } else {
          // それ以外はすべてのプロフィールを取得する
          $profiles = Profile::all();
      }
      return view('admin.profile.index', ['profiles' => $profiles, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
      // Profile Modelからデータを取得する
      $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);
    }

    public function update(Request $request)
    {
      // ユーザーデータをProfileモデルの$rulesに沿ってValidationをかける
      $this->validate($request, Profile::$rules);
      // Profileモデルからユーザーデータの中のIDを取得し、$profileに代入
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを$profile_formに代入
      $profile_form = $request->all();
      // トークンを削除
      unset($profile_form['_token']);
      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
      
      $profilehistory = new Profilehistory;
      $profilehistory->profile_id = $profile->id;
      $profilehistory->edited_at = Carbon::now();
      $profilehistory->save();
        
      return redirect('admin/profile/');
    }
    
    public function delete(Request $request)
    {
      // 該当するProfileモデルを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
    }  
}
