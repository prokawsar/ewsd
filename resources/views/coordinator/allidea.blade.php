@section('title', 'All Submitted Ideas')

@extends('layouts.qacoor')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
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
                                        <th>Idea</th>
                                        <th>Category</th>
                                        <th>Publish Status</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @if( !$draftIdeas->isEmpty() )
                                        @foreach( $draftIdeas as $idea)
                                            <tr>
                                                <td>{{ $idea->created_at->toDateString()  }}</td>
                                                <td>{{ $idea->idea}}</td>
                                                <td>{{ $idea->cat_id }}</td>
                                                <td>{{ $idea->approve }}</td>
                                                <td><a class="btn btn-warning"
                                                       href="{{route('ideaIgnore', ['id' => $idea->id])}}">Ignore</a>
                                                </td>

                                                <td><a class="btn btn-success"
                                                       href="{{route('ideaApprove', ['id' => $idea->id])}}">Approve</a>
                                                </td>

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
            </div>
        </div> <!-- end row -->

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Published Ideas</div>
                    <div id="postsTable" class="panel-body">
                        @foreach($pubIdeas as $posts)

                            <div class="row" id="eachPost{{$posts->id}}">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><strong>Posted by
                                                &nbsp</strong>
                                            {{$posts->created_at->diffForHumans()}}

                                            <span class="cust-badge badge-success"><strong>{{ $posts->cat_id }}</strong> </span>
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
                                                    @endphp

                                                    @if($likeCount==1)

                                                        {{$likeCount." Like "}}

                                                    @elseif ($likeCount==0)

                                                    @else
                                                        <span>{{$likeCount." Likes "}} </span>
                                                    @endif

                                                    <span id="likeArea" style="width: 2%"
                                                          data-id="{{$posts->id}}"
                                                          data-id1="{{Auth::id()}}">
                                                <a style="cursor: pointer;text-decoration: none;color: #040b02"
                                                   id="{{ $posts->id }}like" title="Like it"><i
                                                            class="fa fa-thumbs-up fa-lg"></i></a>
                                            </span>
                                                    &nbsp
                                                    @if($dislikeCount==1)

                                                        {{$dislikeCount." Dislike "}}

                                                    @elseif ($dislikeCount==0)

                                                    @else
                                                        {{$dislikeCount." Dislikes "}}
                                                    @endif

                                                    <span id="unlikeArea"
                                                          style="width: 2%" data-id="{{$posts->id}}"
                                                          data-id1="{{Auth::id()}}">
                                                <a style="cursor: pointer" title="Dislike" id="dislike"><i
                                                            class="fa fa-thumbs-down fa-lg"></i></a>
                                            </span>

                                                </div>
                                                <br>


                                                <!-- showing comments -->
                                                @php
                                                    $comments=\App\Comment::where('idea_id',$posts->id)->orderBy('created_at', 'asc')->get();
                                                @endphp

                                                @if(count($comments)==0)
                                                    <label for="" class="label label-default"> {{count($comments)}}
                                                        Comment</label>
                                                @else

                                                    <label for="" class="label label-primary"> {{count($comments)}}
                                                        Comments</label>

                                                @endif
                                                <div class="panel-body" id="commentsSec{{$posts->id}}">

                                                    <div class="@php if(count($comments)!=0) {echo 'well well-sm';} @endphp">
                                                        @foreach($comments as $cmt)

                                                            <span class="user"> username </span> <i
                                                                    class="fa fa-terminal"></i>  {{$cmt->comment}} <br/>
                                                            {{$cmt->created_at->diffForHumans()}} <br/>
                                                            <hr class="style"></hr>

                                                        @endforeach
                                                    </div>
                                                </div>


                                                <div id="commentArea{{$posts->id}}" data-id="{{$posts->id}}"
                                                     data-id1="{{\Illuminate\Support\Facades\Auth::id()}}">

                                                    <textarea onkeyup="increaseHeight(this);" id="{{$posts->id}}comment"
                                                              placeholder="Write a comment..." type="text"
                                                              class="form-control" name="comment"
                                                              style="padding-top:10px;"></textarea>
                                                    <br/> <a class=" btn btn-default pull-right"
                                                             id="commentPostButton{{$posts->id}}"
                                                             onclick="return commentButtonClicked('{{$posts->id}}','1')"><i
                                                                class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                                        comment</a>
                                                    &nbsp;
                                                </div>

                                            </div>

                                            {{--</div>--}}

                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{--</div>--}}


                        @endforeach
                        {{ $pubIdeas->links() }}

                    </div>
                </div>
            </div>
        </div> <!-- end row -->

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


