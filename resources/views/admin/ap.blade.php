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
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            {{-- <th scope="col">phone</th>
            <th scope="col">Gender</th>
            <th scope="col">Age</th> --}}
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            {{-- <td>{{$item->phone}}</td>
            <td>{{$item->gender}}</td>
            <td>{{$item->age}}</td> --}}
            <td><a href="{{ route('admin.edit',$item->id) }}">approve</a>&nbsp;<a href="{{ route('admin.destroy',['id'=>$item->id])}}">reject</a></td>
          </tr>
            @endforeach
            {{-- {{ route('admin.destroy',['id'=>$item->id])}} --}}
        </tbody>
    </table>
</body>
</html>
@endsection

