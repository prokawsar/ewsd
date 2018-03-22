@section('title', 'Idea of Each Department')

@php if( Auth::user()->hasRole('admin'))
    {$role = 'layouts.admin';}
elseif( Auth::user()->hasRole('coordinator'))
    {$role = 'layouts.qacoor';}
else
    {$role = 'layouts.QAman';}
@endphp

@extends($role)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @php
                        $ideas = \App\Idea::select('depart_id', DB::raw('count(*) as total'))->groupBy('depart_id')->get();
                       // dd($ideas);
                    @endphp
                    <div class="panel-heading">Number of Ideas each Department</div>
                    <div class="panel-body">

                        @php

                                @endphp
                        <div class="col-md-12 ">
                            <table id="example1" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Department Name</th>
                                    <th>Number of IDEA</th>
                                    <th>Sharing Percentage</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php
                                    $total = 0;

                                    foreach($ideas as $idea){
                                        $total += $idea->total;
                                    }
                                @endphp

                                @foreach($ideas as $idea)
                                    @php
                                        $name = \App\Department::select('depart_name')->where('id', $idea->depart_id)->first();

                                    @endphp
                                    <tr>
                                        <td>{{ $name->depart_name }}</td>
                                        <td>{{ $idea->total }}</td>
                                        <td>{{  100 / $total * $idea->total  }}%</td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
