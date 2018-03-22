@section('title', 'Most Commented ideas')

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
                <div class="panel-heading">Most Viewed IDEA List</div>
                @php
                    $ideas = \App\Visited::with('idea')->select( 'idea_id', DB::raw('count(id) as total'))

                                    ->groupBy('idea_id')
                                    ->orderBy('total', 'desc')

                                    ->get();
                  //  dd($ideas);
                @endphp

                <div class="panel-body">
                <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Idea </th>
                        <th>No of Views</th>
                      </tr>
                      
                      </thead>
                      <tbody>
                      @foreach($ideas as $idea)
                        <tr>
                            <td>{{ $idea->idea->idea }}</td>
                            <td>{{ $idea->total }}</td>

                        </tr>
                          @endforeach
                    </tbody>
              
                  </table>
               
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
