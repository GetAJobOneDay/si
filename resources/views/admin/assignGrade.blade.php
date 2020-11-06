@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        //session_start();
        if(isset($_SESSION['student'])){
            $name = $_SESSION['student'];
           echo "<h2>$name</h2>";
        }
    ?>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">course id</th>
            <th scope="col">course name</th>
            <th scope="col">credit</th>
            {{-- <th scope="col">phone</th>
            <th scope="col">Gender</th>
            <th scope="col">Age</th> --}}
            <th scope="col">GRADING</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
            <th scope="row">{{$item->course_id}}</th>
            <td>{{$item->course_name}} </td>
            <td>{{$item->credit}}</td>
            {{-- <td>{{$item->phone}}</td>
            <td>{{$item->gender}}</td>
            <td>{{$item->age}}</td> --}}
            <td><form action="/updategrade" method="GET">
                        {!! Form::select('grade',array(
                            'A'=>'A',
                            'B+'=>'B+',
                            'B'=>'B',
                            'C+'=>'C+',
                            'C'=>'C',
                            'D+'=>'D+',
                            'D'=>'D',
                            'F'=>'F',
                        )) !!}
                        <input type="hidden" value="{{$item->course_id}}" name="cid">
                        <input type="hidden" value="{{$item->student_id}}" name="sid">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-warning"><td> </td>
                    <td>
                </form>
            </tr>

            @endforeach
            {{-- {{ route('admin.destroy',['id'=>$item->id])}} --}}
        </tbody>
    </table>

</body>
</html>
@endsection
