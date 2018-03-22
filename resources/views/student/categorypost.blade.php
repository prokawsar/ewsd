@section('title', 'Ideas')

@extends('layouts.student')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Idea feed</div>
                    <div id="postsTable" class="panel-body">
                        @foreach($posts as $post)

                            <div class="row" id="eachPost{{$post->id}}">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><strong>Posted by
                                                @if( !$post->anonym )
                                                    {{ $post->user->name }}
                                                @else
                                                    Anonymous
                                                @endif
                                                &nbsp</strong>
                                            {{$post->created_at->diffForHumans()}}

                                            <div class="pull-right">
                                                <!-- $category = \App\PostCategory::where('id',$posts->cat_id)->select('cat_name')->first(); -->

                                                @php
                                                    $category= App\Category::find($post->cat_id);
                                                @endphp

                                                [ <span class="badge badge-success">  <i
                                                            class="fa fa-tags"></i> <strong>{{ $category->cat_name}}</strong> </span>
                                                ]
                                            </div>
                                        </div>
                                        <div class="panel-body" id="postDiv">
                                            <blockquote>

                                                <a class="post_link" href="{{ route('singleIdea', ['id' => $post->id]) }}" target="_blank">
                                                    <p>{{$post->idea }}</p></a>

                                            </blockquote>


                                            <div id="reload{{$post->id}}" class="reloadMyWall">

                                                <!-- counting likes -->

                                                <div id="{{ $post->id }}areaDefine">
                                                    @php
                                                        $likeCount=\App\Like::where('idea_id',$post->id)->where('status', 1)->count();
                                                        $dislikeCount=\App\Like::where('idea_id',$post->id)->where('status', 0)->count();
                                                        $userCheck =\App\Like::where('idea_id', $post->id )->where('user_id', Auth::id())->first();
                                                        $view = \App\Visited::where('idea_id', $post->id)->count();

                                                 //  dd($userCheck->status);
                                                    @endphp


                                                    <span @if( is_null($userCheck)) id="likeArea"
                                                          @elseif( $userCheck->status !== 1) id="likeArea"
                                                          @endif
                                                          data-value="1"
                                                          data-id="{{$post->id}}"
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
                                                            data-id="{{$post->id}}"
                                                            data-id1="{{Auth::id()}}">

                                                            <a style="cursor: pointer; text-decoration: none;" title="Dislike" id="dislike"><i
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
                                                    $comments=\App\Comment::with('user')->where('idea_id',$post->id)->orderBy('created_at', 'asc')->get();

                                                @endphp

                                                @if(count($comments)==0)
                                                    <label for="" class="label label-default"> {{count($comments)}}
                                                        Comment</label>
                                                @else

                                                    <label for="" class="label label-primary"> {{count($comments)}}
                                                        Comments</label>

                                                @endif


                                            </div>

                                            {{--</div>--}}

                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{--</div>--}}


                        @endforeach
                        {{ $posts->links() }}

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


