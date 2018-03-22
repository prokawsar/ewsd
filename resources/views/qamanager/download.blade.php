@section('title', 'Download Ideas')

@extends('layouts.QAman')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Downloadable Ideas</div>
                    @php
                        $ideas = App\Idea::with('user', 'file')->paginate(5);
                   //  dd($ideas[2]->file);
                    @endphp
                    <div class="panel-body">


                        <table id="example1" class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Submitted by</th>
                                <th>Idea</th>
                                <th>Submitted on</th>
                                <th>Attached File</th>

                            </tr>

                            </thead>

                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($ideas as $idea)

                                    <input type="hidden" name="idea_id" value="{{ $idea->id }}">
                                    <tr>
                                        <td> # {{ $i++ }}</td>
                                        <td>{{ $idea->user->name }}</td>
                                        <td>{{ $idea->idea }}</td>
                                        <td>{{ $idea->created_at->format('d-m-Y') }}</td>
                                        <td>@if( $idea->file->isEmpty() ) No @else Yes @endif</td>
                                        @if( !$idea->file->isEmpty())
                                            <td>
                                                <a type="submit" href="{{ route('downloadzip', ['id' => $idea->id]) }}" class="btn btn-success pull-right"> Download
                                                </a>
                                            </td>
                                        @endif
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
