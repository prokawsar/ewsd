@section('title', 'All Submitted Ideas')

@extends('layouts.qacoor')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if (session('warning'))
                                    <div class="alert alert-warning">
                                        {{ session('warning') }}
                                    </div>
                                @endif

                                <table id="example1" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Idea Description</th>
                                        <th>Category</th>
                                        <th>Submitted on</th>
                                        <th>Publish Status</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @if( !$draftIdeas->isEmpty() )
                                        @foreach( $draftIdeas as $idea)
                                            <tr>
                                                <td>{{ $idea->user->name  }}</td>
                                                <td>{{ $idea->idea}}</td>
                                                <td>{{ $idea->category->cat_name }}</td>
                                                <td>{{ $idea->created_at->diffForHumans() }}</td>
                                                <td> Pending</td>
                                                <td><a class="btn btn-warning"
                                                       href="{{route('ideaIgnore', ['id' => $idea->id])}}">Decline</a>
                                                </td>

                                                <td><a class="btn btn-success"
                                                       href="{{route('ideaApprove', ['id' => $idea->id])}}">Approve</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <td class="warning text-center" colspan="5">No Pending Idea</td>
                                    @endif
                                    </tbody>
                                {{ $draftIdeas->links() }}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->

    </section> 

</div>
@endsection
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<script src="{{ asset('js/posts.js') }}"></script>
<script>

    var token = '{{csrf_token()}}';

    function increaseHeight(e) {
        e.style.height = 'auto';
        var newHeight = (e.scrollHeight > 32 ? e.scrollHeight : 32);
        e.style.height = newHeight.toString() + 'px';
    }


</script>


