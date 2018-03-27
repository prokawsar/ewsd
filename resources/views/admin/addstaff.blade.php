@section('title', 'Staff Add')

@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content">
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

                                    @if (session('warning'))
                                        <div class="alert alert-warning">
                                            {{ session('warning') }}
                                        </div>
                                    @endif
                                    <form class="form-horizontal" method="POST" action="{{ route('addstaff') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-md-4 control-label">Name</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name"
                                                       value="{{ old('name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email"
                                                       value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label">Password</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control"
                                                       name="password"
                                                       required>

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="role" class="col-md-4 control-label">Role</label>

                                            <div class="col-md-6">
                                                @php
                                                    $role = \App\Role::all();
                                                    $department = \App\Department::all();
                                                @endphp
                                                <select class="form-control" id="role" name="role">
                                                    @foreach($role as $dept)
                                                        @if($dept->role_name == 'coordinator' || $dept->role_name == 'qamanager' )
                                                            <option value="{{ $dept->id }}">{{ $dept->role_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="department_div">
                                            <label for="department" class="col-md-4 control-label">Department</label>

                                            <div class="col-md-6">

                                                <select class="form-control" id="department" name="department">
                                                    @foreach($department as $dept)

                                                        <option value="{{ $dept->id }}">{{ $dept->depart_name }}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

        </section>
    </div>
@endsection
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>

<script>
    $(document).on('change', '#role', function () {
        if ($('#role option:selected').text() == 'coordinator') {
            $('#department_div').show();
            console.log('coordinator');
        } else {
            $('#department_div').hide();
        }

    });

</script>



