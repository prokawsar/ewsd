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
                 $contributor = \App\Idea::with('department')->select('depart_id',  DB::raw('count(DISTINCT student_id) as total'))
                            ->groupBy('depart_id')
                            ->get();

            //    dd($contributor);

                @endphp
                <div class="panel-heading">Number of Contributor each Department</div>
                <div class="panel-body">

                    @php

                    @endphp
                  <!-- <div class="col-md-12 "> -->
                    <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Depertment Name</th>
                        <th>Number of Contributor</th>
                        {{--<th>Sharing Percentage</th>--}}
                      </tr>
                      
                      </thead>
                      <tbody>
                      @foreach($contributor as $person)
                        <tr>
                            <td>{{ $person->department->depart_name }}</td>
                            <td>{{ $person->total }}</td>
                        
                        </tr>
                          @endforeach
                    </tbody>
              
                  </table>
                  <!-- </div> -->
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
