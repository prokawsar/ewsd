@section('title', 'Coordinator')

@extends('layouts.qacoor')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @php
                        $count = App\Idea::where('approve', 0)->count();
                    @endphp
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ $count }}</h3>

                                <p>Pending Ideas</p>
                            </div>
                            <div>
                                <i class="fa fa-clock"></i>
                            </div>
                            <a href="{{ route('coorideas') }}" class="small-box-footer">
                                View ideas<i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
