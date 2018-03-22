@section('title', 'Contributor of Each Department')

@php if( Auth::user()->hasRole('admin'))
    $role = 'layouts.admin';
elseif( Auth::user()->hasRole('coordinator'))
    $role = 'layouts.qacoor';
else
    $role = 'layouts.QAman';
@endphp

@extends($role)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @php
                   // $ideas = \App\Idea::select('cat_id', DB::raw('count(*) as total'))->groupBy('cat_id')->get();
                   // dd($ideas);
                @endphp
                <div class="panel-heading">Number of Contributor each Department</div>
                <div class="panel-body">

                    @php

                    @endphp
                  <div class="col-md-12 ">
                    <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Depertment Name</th>
                        <th>Number of Contributor</th>
                        {{--<th>Sharing Percentage</th>--}}
                      </tr>
                      
                      </thead>
                      <tbody>
                        <tr>
                            <td>Science</td>
                            <td><a href="{{ url('/ideas')}}">10</a></td>
                        
                        </tr>                
                    </tbody>
              
                  </table>
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
