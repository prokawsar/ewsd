@section('title', 'QAM Add Category')

@extends('layouts.QAman')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <div class="panel panel-default">

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

                    <div class="panel-heading">Add Catagories</div>
                    <div class="panel-body">

                        <div class="col-md-10 ">
                            <table id="example1" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date From</th>
                                    <th>To</th>
                                    <th>Final Deadline</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php
                                    $categories = \App\Category::with('department')->get();
                                  //  dd($categories);
                                @endphp
                                @foreach( $categories as $category)
                                    <tr>
                                        <td>{{ $category->cat_name }}</td>
                                        <td>{{ $category->start_date->toDateString() }}</td>
                                        <td>{{ $category->end_date->toDateString() }}</td>
                                        <td>{{ $category->final_end_date->diffForHumans() }}</td>
                                        {{--<td><a class="btn btn-info" href="{{ route('editcat', ['id' => $category->id]) }}" title="Reassign">Reassign Date</a></td>--}}
                                        <td><a href="{{ route('delcat', ['id' => $category->id]) }}" title="Remove"><i class="fa fa-remove"></i></a></td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="col-md-10 ">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ url('/qamanager/addcat') }}">
                                {{ csrf_field() }}


                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ old('name') }}" autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('datefrom') ? ' has-error' : '' }}">
                                    <label for="date" class="col-md-4 control-label">Date From</label>

                                    <div class="col-md-6">
                                        <input id="datefrom" type="text" class="form-control" name="datefrom"
                                               value="{{ old('datefrom') }}">

                                        @if ($errors->has('datefrom'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('datefrom') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('dateto') ? ' has-error' : '' }}">
                                    <label for="dateto" class="col-md-4 control-label">Date To</label>

                                    <div class="col-md-6">
                                        <input id="dateto" type="text" class="form-control" name="dateto">

                                        @if ($errors->has('dateto'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('dateto') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('finaldate') ? ' has-error' : '' }}">
                                    <label for="finaldate" class="col-md-4 control-label">Final Date</label>

                                    <div class="col-md-6">
                                        <input id="finaldate" type="text" class="form-control" name="finaldate">

                                        @if ($errors->has('finaldate'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('finaldate') }}</strong>
                                    </span>
                                        @endif
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
    </div>
@endsection


