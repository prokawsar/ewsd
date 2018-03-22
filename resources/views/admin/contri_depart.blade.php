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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @php
                 //   $contributor= DB::table('ideas')->select('departments.depart_name as dname',DB::raw('COUNT(DISTINCT student_id) as contributor '))
                  //              ->groupBy('depart_id')
                    //            ->leftJoin('departments','departments.id','=','ideas.depart_id')
                   //             ->get();
                //dd($contributor);

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
