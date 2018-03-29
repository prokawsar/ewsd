@section('title', 'Download Ideas')

@extends('layouts.QAman')

@section('content')

   <div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Downloadable Contribution</div>
                    @php
                        $ideas = App\Idea::with('user', 'file', 'category')->paginate(5);
                   //  dd($ideas[2]->file);
                    @endphp
                    <div class="panel-body">


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Submitted by</th>
                                <th>Idea</th>
                                <th>Category</th>
                                <th>Submitted on</th>

                            </tr>

                            </thead>

                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($ideas as $idea)
                                @if($idea->category->final_end_date < \Carbon\Carbon::today())
                                    @if( !$idea->file->isEmpty())
                                        <input type="hidden" name="idea_id" value="{{ $idea->id }}">
                                        <tr>
                                            <td> # {{ $i++ }}</td>
                                            <td>{{ $idea->user->name }}</td>
                                            <td>{{ $idea->idea }}</td>
                                            <td>{{ $idea->category->cat_name }}</td>
                                            <td>{{ $idea->created_at->format('d-m-Y') }}</td>
                                        
                                                <td>
                                                    <a type="submit" href="{{ route('downloadzip', ['id' => $idea->id]) }}"
                                                    class="btn btn-success pull-right"> Download
                                                    </a>
                                                </td>
                                            
                                        </tr>
                                    @endif
                                @endif

                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>

@endsection
