<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeline;
use Session;

class TimelineController extends Controller
{
    public function timeline(){
        $timeline = new Timeline();
        $data['timeline'] = $timeline->data()->get();
        return view('timeline/timeline', $data);
    }

    public function insert(Request $request){
        $input = $request->except(['_token']);

        if(isset($input['thumbnail'])){
            $imageName = 'thumbnail'.time().'.'.$request->file('thumbnail')->extension();  
            $request->file('thumbnail')->move(public_path('gambar'), $imageName);
            $input['thumbnail'] = $imageName;
        } 

        $userId = Session::get('user')->id;
        $input['user_id'] = $userId;
        $input['created_at'] = date('Y-m-d H:i:s');

        $timeline = new Timeline();
        $timeline->create($input);

        return redirect('timeline')->with('alert', show_alert('Timeline berhasil dipost', 'success'));
    }

    public function delete($timeline_id){
        if(!is_user() && !is_admin()){
            return redirect('');
        }

        $timeline = new Timeline();
        $exist = $timeline->data([
                        'timeline.id' => $timeline_id,
                        'user_id'     => Session::get('user')->id
                   ])->count();

        if($exist == 0){
            return redirect('timeline')->with('alert', show_alert('Data postingan tidak ditemukan', 'danger'));
        }

        $timeline->deletes($timeline_id);

        return redirect('timeline')->with('alert', show_alert('Postingan berhasil dihapus', 'success'));
    }

    public function edit($timeline_id){
        if(!is_user() && !is_admin()){
            return redirect('');
        }

        $timeline = new Timeline();
        $exist = $timeline->data([
                        'timeline.id' => $timeline_id,
                        'user_id'     => Session::get('user')->id
                   ]);

        if($exist->count() == 0){
            return redirect('timeline')->with('alert', show_alert('Data postingan tidak ditemukan', 'danger'));
        }

        $data['timeline'] = $timeline->first();

        return view('timeline/edit', $data);
    }

    public function update(Request $request, $timeline_id){
        if(!is_user() && !is_admin()){
            return redirect('');
        }

        $input = $request->except(['_token']);

        $timeline = new Timeline();
        $exist = $timeline->data([
                        'timeline.id' => $timeline_id,
                        'user_id'     => Session::get('user')->id
                   ])->count();

        if($exist == 0){
            return redirect('timeline')->with('alert', show_alert('Data postingan tidak ditemukan', 'danger'));
        }

        if(isset($input['thumbnail'])){
            $imageName = 'thumbnail'.time().'.'.$request->file('thumbnail')->extension();  
            $request->file('thumbnail')->move(public_path('gambar'), $imageName);
            $input['thumbnail'] = $imageName;
        }
        $input['updated_at'] = date('Y-m-d H:i:s');

        $timeline->updates($input, $timeline_id);

        return redirect('timeline')->with('alert', show_alert('Postingan berhasil diubah', 'success'));
    }
}
