<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('tasks');

    $tasks = App\Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

Route::post('/task',function(Request $request){
    $validator = $request->validate([
        'name' => 'required|max:255'

    ]);
    // if ($validator->fails()) {
    //     return redirect('/')
    //         ->withInput()
    //         ->withErrors($validator);
    // }
    // $link = tap(new App\Link($data))->save();

    $task = new App\Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');


});
Route::delete('/task/{id}',function($id){

    App\Task::findOrFail($id)->delete();

    return redirect('/');
});