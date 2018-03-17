@section('title', 'Student Home')

@extends('layouts.student')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Share your idea.....</div>
                            <div class="panel-body">
                                <span class="label label-success postConfirm" style="font-size: 15px"></span>
                                <span class="label label-danger validation" style="font-size: 15px"></span>

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form id="cform" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{ \Illuminate\Support\Facades\Auth::id() }}"
                                           name="user_id" id="user_id">

                                    {{--<fieldset>--}}
                                    <div class="form-group">
                                            <textarea name="posts" id="posts" cols="10" rows="5"
                                                      class="form-control"></textarea>
                                    </div>

                                    @php
                                        //retrieve all category
                                        $categories = \App\Category::all();
                                    @endphp

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select class="form-control" name="category" id="category">
                                                <option value="#">Select a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label for="file" class="col-md-3 control-label">Supporting file/s: </label>

                                        <div class="col-md-8">
                                            <input type="file" name="file[]" class="form-control" multiple>
                                        </div>

                                    </div>

                                    <br>
                                    <br>


                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" required> I have read <a
                                                            href="#" target="_blank">Terms and Conditions</a>

                                                </label>
                                                <span class="pull-right">
                                                        <input title="Anonymously" type="checkbox" id="anonym"
                                                               name="anonym"> Post Anonymously
                                                    </span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <button class="btn btn-primary pull-right" id="submitIdea"><i
                                                    class="fa fa-terminal"></i> Submit
                                        </button>
                                    </div>
                                    {{--</fieldset>--}}
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Idea feed</div>
                    <div id="postsTable" class="panel-body">
                        @foreach($allIdeas as $posts)

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
                                                        $userCheck =\App\Like::where('idea_id', $posts->id )->where('user_id', Auth::id())->get();

                                                   // dd($userCheck);
                                                    @endphp

                                                    @if($likeCount==1)

                                                        {{$likeCount." Like "}}

                                                    @elseif ($likeCount==0)

                                                    @else
                                                        {{$likeCount." Likes "}}
                                                    @endif

                                                    <span id="likeArea" style="width: 2%"
                                                          data-id="{{$posts->id}}"
                                                          data-id1="{{Auth::id()}}">
                                                        @if( count($userCheck) == 0)
                                                            <a style="cursor: pointer;text-decoration: none;color: #040b02"
                                                               id="{{ $posts->id }}like" title="Like it"><i
                                                                        class="fa fa-thumbs-up fa-lg"></i></a>
                                                        @endif
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
                                                        @if( count($userCheck) == 0 )
                                                            <a style="cursor: pointer" title="Dislike" id="dislike"><i
                                                                        class="fa fa-thumbs-down fa-lg"></i></a>
                                                        @endif
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
                                                    <br/>

                                                    <input title="Anonymously" type="checkbox" id="anonymComment"
                                                           name="anonymComment"> Comment Anonymously

                                                    <a class=" btn btn-default pull-right"
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
                        {{ $allIdeas->links() }}

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


