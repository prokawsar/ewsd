@section('title', 'Anonymous Idea and Comment')

@php if( Auth::user()->hasRole('admin'))
    {$role = 'layouts.admin';}
elseif( Auth::user()->hasRole('coordinator'))
    {$role = 'layouts.qacoor';}
else
    {$role = 'layouts.QAman';}
@endphp

@extends($role)

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @php
                        $ideas = \App\Idea::select('cat_id', DB::raw('count(*) as total'))->groupBy('cat_id')->get();
                     //   dd($ideas);
                    @endphp
                    <div class="panel-heading">Anonymous Ideas and Comments</div>
                    <div class="panel-body">

                        @php
                            $ideas = \App\Idea::where('anonym', 1)->get();
                            $comments = \App\Comment::where('anonym', 1)->get();

                        @endphp
                        <div class="col-md-12 ">
                            <table id="example1" class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-left">Anonymous Ideas</th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($ideas as $idea)
                                    <tr>
                                        <td>{{ $idea->idea }}</td>
                                        <td>{{ $idea->created_at->diffForHumans() }}</td>

                                    </tr>
                                @endforeach

                            <th class="text-left"> Anonymous Comments </th>
                                @foreach($comments as $idea)
                                    <tr>
                                        <td>{{ $idea->comment }}</td>
                                        <td>{{ $idea->created_at->diffForHumans() }}</td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
