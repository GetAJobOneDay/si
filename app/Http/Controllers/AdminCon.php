<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('users')->where('approve', false)->get();
       return view('admin.ap',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::select('SELECT name,c.course_id,c.course_name,r.student_id,c.credit from users
        inner join registrations r on id = r.student_id
        inner join courses c on c.course_id = r.course_id
        where id = ? and r.ce = 0', [$id]);
        if(!empty($data)){
           $form = json_encode($data);
        $form = json_decode($form,true);
        session_start();
        $_SESSION['student'] = $form[0]["name"];
        return view('admin.assignGrade',compact(['data']));
        }else{
            session_start();
             $_SESSION['message'] = "This student have nothing to do with";
            return redirect('/grade');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        DB::update('update users set approve = true where id = ?', ["$id"]);
        return redirect('/admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cid = $_GET['cid'];
        $sid = $_GET['sid'];
        $grade = $_GET['grade'];
        DB::update('UPDATE registrations set grade = ? , ce=1 where student_id = ? and course_id=?', [$grade,$sid,$cid]);
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from users where id = ?', [$id]);
        return redirect('/admin');
    }
}
