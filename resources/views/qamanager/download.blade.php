@section('title', 'Download Ideas')

@extends('layouts.QAman')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Downloadable Ideas</div>
                    @php
                        $ideas = App\Idea::with('user', 'file')->get();
                   //  dd($ideas[2]->file);
                    @endphp
                    <div class="panel-body">
                        <form action="{{ route('downloadzip') }}" method="post">
                            {{ csrf_field() }}

                            <table id="example1" class="table table-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Submitted by</th>
                                    <th>Idea</th>
                                    <th>Submitted on</th>
                                    <th>Attached Doc</th>

                                </tr>

                                </thead>

                                <tbody>
                                @foreach($ideas as $idea)
                                    <tr>
                                        <td><input type="checkbox" name="select[]" value="{{ $idea->id }}"></td>
                                        <td>{{ $idea->user->name }}</td>
                                        <td>{{ $idea->idea }}</td>
                                        <td>{{ $idea->created_at->format('d-m-Y') }}</td>
                                        <td>@if( $idea->file->isEmpty() ) No @else Yes @endif</td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                            <button type="submit" class="btn btn-success pull-right"> Download</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
