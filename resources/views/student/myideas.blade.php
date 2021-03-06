@section('title', 'My ideas')

@extends('layouts.student')

@section('content')
    <div class="content-wrapper">
        <section class="content">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading"></div>
                        <div class="panel-body">

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <table class="table">
                                <thead>
                                <td class="active text-center" colspan="4">Submitted Ideas</td>

                                <tr>
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
                                            <td>{{ $idea->idea}}</td>
                                            <td>{{ $idea->category->cat_name }}</td>
                                            <td>{{ $idea->created_at->diffForHumans() }}</td>
                                            <td> <a class="btn btn-warning" href="{{ route('cancel', ['id' => $idea->id ]) }}">Cancel</a> </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <td class="warning text-center" colspan="4">No Pending Idea</td>
                                @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

    <!-- end row -->

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- <div class="panel panel-primary"> -->
            <!-- <div class="panel-heading">Approved Idea</div> -->
            <!-- <div id="postsTable" class="panel-body"> -->
            @foreach($allIdeas as $posts)

                <div class="row" id="eachPost{{$posts->id}}">
                    <!-- <div class="col-md-12"> -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{$posts->created_at->diffForHumans()}}

                            <div class="pull-right">
                                <!-- $category = \App\PostCategory::where('id',$posts->cat_id)->select('cat_name')->first(); -->

                                @php
                                    $category= App\Category::find($posts->cat_id);
                                @endphp

                                [ <span class="badge badge-success">  <i
                                            class="fa fa-tags"></i> <strong>{{ $category->cat_name}}</strong> </span>
                                ]
                            </div>
                        </div>
                        <div class="panel-body" id="postDiv">
                            <blockquote>

                                <a class="post_link" href="posts/{{$posts->id}}/show" target="_blank">
                                    <p>{{$posts->idea }}</p></a>

                            </blockquote>


                            <div id="reload{{$posts->id}}" class="reloadMyWall">

                                <!-- counting likes -->

                                <div id="{{ $posts->id }}areaDefine">
                                    @php
                                        $likeCount=\App\Like::where('idea_id',$posts->id)->where('status', 1)->count();
                                        $dislikeCount=\App\Like::where('idea_id',$posts->id)->where('status', 0)->count();
                                        $userCheck =\App\Like::where('idea_id', $posts->id )->where('user_id', Auth::id())->first();
                                        $view = \App\Visited::where('idea_id', $posts->id)->count();

                                 //  dd($userCheck->status);
                                    @endphp


                                    <span @if( is_null($userCheck)) id="likeArea"
                                          @elseif( $userCheck->status !== 1) id="likeArea"
                                          @endif
                                          data-value="1"
                                          data-id="{{$posts->id}}"
                                          data-id1="{{Auth::id()}}">

                                                            <a style="cursor: pointer;text-decoration: none;"

                                                               title="Like it"><i
                                                                        class="fa @if( !is_null($userCheck) && $userCheck->status===1)fa-thumbs-up @else fa-thumbs-o-up @endif  fa-lg"></i> {{$likeCount }}
                                                                Like</a>


                                            </span>
                                    &nbsp

                                    <span
                                            @if( is_null($userCheck)) id="unlikeArea"
                                            @elseif( $userCheck->status !== 0) id="unlikeArea"
                                            @endif
                                            id="unlikeArea"
                                            data-value="0"
                                            data-id="{{$posts->id}}"
                                            data-id1="{{Auth::id()}}">

                                                            <a style="cursor: pointer; text-decoration: none;"
                                                               title="Dislike" id="dislike"><i
                                                                        class="fa @if( !is_null($userCheck) && $userCheck->status===0)fa-thumbs-down @else fa-thumbs-o-down @endif fa-lg"></i> {{ $dislikeCount }}
                                                                Dislike</a>

                                                    </span>

                                    <span>
                                                            <a><i class="fa fa-eye fa-lg"></i>
                                                                {{ $view }} View</a>

                                                    </span>

                                </div>
                                <br>


                                <!-- showing comments -->
                                @php
                                    $comments=\App\Comment::with('user')->where('idea_id',$posts->id)->orderBy('created_at', 'asc')->get();

                                @endphp

                                @if(count($comments)==0)
                                    <label for="" class="label label-default"> {{count($comments)}}
                                        Comment</label>
                                @else

                                    <label for="" class="label label-primary"> {{count($comments)}}
                                        Comments</label>

                                @endif
                                {{--<div class="panel-body" id="commentsSec{{$posts->id}}">--}}

                                {{--<div class="@php if(count($comments)!=0) {echo 'well well-sm';} @endphp">--}}
                                {{--@foreach($comments as $cmt)--}}

                                {{--@if( $cmt->user->hasRole('student'))--}}
                                {{--<span class="user"> <i class="fa fa-user"></i>--}}
                                {{--@if($cmt->anonym)--}}
                                {{--Anonymous--}}
                                {{--@else--}}
                                {{--{{ $cmt->user->name  }}--}}
                                {{--@endif--}}
                                {{--</span> <i--}}
                                {{--class="fa fa-terminal"></i>  {{$cmt->comment}}--}}
                                {{--@if($cmt->user_id == Auth::id()) <a style="cursor: pointer" id="deleteComment" data-id="{{ $posts->id }}" data-value="{{ $cmt->id }}"><i type="button" class="fa fa-trash pull-right"></i></a>--}}
                                {{--@endif--}}
                                {{--<br/>--}}
                                {{--{{$cmt->created_at->diffForHumans()}} <br/>--}}
                                {{--<hr class="style"></hr>--}}
                                {{--@endif--}}

                                {{--@endforeach--}}
                                {{--</div>--}}
                                {{--</div>--}}


                                {{--<div id="commentArea{{$posts->id}}" data-id="{{$posts->id}}"--}}
                                {{--data-id1="{{\Illuminate\Support\Facades\Auth::id()}}">--}}

                                {{--<textarea onkeyup="increaseHeight(this);" id="{{$posts->id}}comment"--}}
                                {{--placeholder="Write a comment..." type="text"--}}
                                {{--class="form-control" name="comment"--}}
                                {{--style="padding-top:10px;"></textarea>--}}
                                {{--<br/>--}}

                                {{--<input title="Anonymously" type="checkbox"--}}
                                {{--id="anonymComment{{ $posts->id }}"--}}
                                {{--name="anonymComment"> Comment Anonymously--}}

                                {{--<a class=" btn btn-default pull-right"--}}
                                {{--id="commentPostButton{{$posts->id}}"--}}
                                {{--onclick="return commentButtonClicked('{{$posts->id}}','{{ Auth::id() }}')"><i--}}
                                {{--class="fa fa-paper-plane-o" aria-hidden="true"></i>--}}
                                {{--comment</a>--}}
                                {{--&nbsp;--}}
                                {{--</div>--}}

                            </div>

                            {{--</div>--}}

                        </div>
                    </div>

                    <!-- </div> -->
                </div>
            {{--</div>--}}


        @endforeach
        {{ $allIdeas->links() }}

        <!-- </div> -->
            <!-- </div> -->
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


