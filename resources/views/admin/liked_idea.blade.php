@php if( Auth::user()->hasRole('admin'))
    {$role = 'layouts.admin';}
elseif( Auth::user()->hasRole('coordinator'))
    {$role = 'layouts.qacoor';}
else
    {$role = 'layouts.QAman';}
@endphp

@section('title', 'Most Commented ideas')

@extends($role)

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">5 Most Liked IDEA List</div>
                    <div class="panel-body">
                        @php
                            $ideas = \App\Like::with('idea')->select( 'idea_id', DB::raw('count(status) as total'))
                                            ->where('status', 1)
                                            ->groupBy('idea_id')
                                            ->orderBy('total', 'desc')
                                            ->take(5)
                                            ->get();
                          //   dd($ideas);
                        @endphp

                        <table id="example1" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Idea</th>
                                <th>No of Likes</th>

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
