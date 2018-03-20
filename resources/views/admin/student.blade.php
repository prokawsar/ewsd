@section('title', 'Student Details')

@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <table id="example1" class="table table-striped">
                                    <thead>
                                    <td class="active text-center" colspan="4"><a class="btn btn-default pull-right" href="{{ route('addstudent') }}">Add Student</a></td>

                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Department</th>
                                    </tr>

                                    </thead>
                                    <tbody>

                                    @foreach( $students as $person)
                                        <tr>
                                            <td>{{ $person->user->name}}</td>
                                            <td>{{ $person->user->email }}</td>
                                            <td>{{ $person->user->phone }}</td>
                                            <td>{{ $person->department->depart_name }}</td>


                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->


    </div>
@endsection



