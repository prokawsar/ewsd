@section('title', 'Student Details')

@extends('layouts.admin')

@section('content')
    <div class="container">
        <!-- <div class="row">
            <div class="col-md-12"> -->
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <form method="POST" action="{{ route('adddepart') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-2 control-label">Name</label>

                                        <div class="col-md-10">
                                            <input id="name" type="text" class="form-control" name="name"
                                                   value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10  col-md-offset-2">
                                            <br>

                                            <button type="submit" class="btn btn-primary btn-block">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <br>
                                <br>
                                <br>
                                
                                
                               

                            </div>


                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                           
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if (session('warning'))
                                    <div class="alert alert-warning">
                                        {{ session('warning') }}
                                    </div>
                                @endif

                                <div class="col-md-12 ">
                                    <table id="example1" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Current Departments</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @php
                                            $departments = \App\Department::all();
                                        @endphp
                                        @foreach( $departments as $category)
                                            <tr>
                                                <td>{{ $category->depart_name }}</td>
                                                <td><a href="{{ route('deldept', ['id' => $category->id]) }}"
                                                       title="Remove"><i class="fa fa-remove"></i></a></td>

                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                
                               

                            </div>


                        </div>
                    </div>

                </div>
            <!-- </div>
        </div>  -->


    </div>
    
@endsection



