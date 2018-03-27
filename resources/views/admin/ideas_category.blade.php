@section('title', 'Ideas of Each Category')

@php if( Auth::user()->hasRole('admin'))
    $role = 'layouts.admin';
elseif( Auth::user()->hasRole('coordinator'))
    $role = 'layouts.qacoor';
else
    $role = 'layouts.QAman';
@endphp

@extends($role)

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @php
                        $ideas = \App\Idea::select('cat_id', DB::raw('count(*) as total'))->groupBy('cat_id')->get();
                     //   dd($ideas);
                    @endphp
                    <div class="panel-heading">Number of Ideas each Category</div>
                    <div class="panel-body">

                        @php

                                @endphp
                        <!-- <div class="col-md-12 "> -->
                            <table id="example1" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Number of Ideas</th>
                                    {{--<th>Sharing Percentage</th>--}}
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($ideas as $idea)
                                    @php
                                        $name = \App\Category::select('cat_name')->where('id', $idea->cat_id)->first();

                                    @endphp
                                    <tr>
                                        <td>{{ $name->cat_name }}</td>
                                        <td><a href="#">{{ $idea->total }}</a></td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        <!-- </div> -->

                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
@endsection
