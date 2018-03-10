@extends('layouts.QAman')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Add Catagories</div>
                <div class="panel-body">
                
                  <div class="col-md-8 ">
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
                        <tr>
                            <td>Campus</td>
                            <td>10/12/2018</td>
                            <td>10/12/2018</td>
                            <td>10/12/2018</td>
                        
                        </tr>                
                    </tbody>
              
                  </table>
                  </div>
                  <div class="col-md-4 ">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

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
                                <input id="datefrom" type="date" class="form-control" name="datefrom" value="{{ old('datefrom') }}">

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
                                <input id="dateto" type="date" class="form-control" name="dateto">

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
                                <input id="finaldate" type="password" class="form-control" name="finaldate">

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
