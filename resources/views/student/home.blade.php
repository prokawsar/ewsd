@section('title', 'Student Home')

@extends('layouts.student')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- <div class="row">
                    <div class="col-md-12 "> -->

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                                data-target="#myModal">Share idea
                        </button>
                        <br>
                        <br>
                        <br>
                        <!-- Modal -->
                        <div class="col-md-6 col-md-offset-1 ">
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog modal-lg">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                                                Close
                                            </button>
                                            <h4 class="modal-title">Share your idea.....</h4>

                                        </div>
                                        <form id="cform" method="post" action="{{ url('/postIdea') }}"
                                            enctype="multipart/form-data">
                                            {{csrf_field()}}

                                            <div class="modal-body">
                                                <span class="label label-danger validation" style="font-size: 15px"></span>


                                                <input type="hidden" value="{{ \Illuminate\Support\Facades\Auth::id() }}"
                                                    name="user_id" id="user_id">

                                                {{--<fieldset>--}}
                                                <div class="form-group">
                                                    <textarea name="posts" id="posts" cols="10" rows="5"
                                                            class="form-control" required></textarea>
                                                </div>

                                                @php
                                                    //retrieve all category
                                                    $categories = \App\Category::where('end_date', '>=', \Carbon\Carbon::today())->get();
                                                    $depart_id = \App\Student::select('depart_id')->where('student_id', Auth::id())->first();
                                                @endphp

                                                <div class="form-group">
                                                    <label for="category" class="col-md-3 control-label">Select
                                                        Category: </label>

                                                    <div class="col-md-8">
                                                        <select class="form-control" name="category" id="category" required>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <br>
                                                <br>

                                                <div class="form-group">
                                                    <label for="file" class="col-md-3 control-label">Supporting
                                                        file/s: </label>

                                                    <div class="col-md-8">
                                                        <input type="file" name="file[]" class="form-control" multiple>
                                                        <input type="hidden" name="depart_id"  value="{{ $depart_id->depart_id }}">
                                                    </div>

                                                </div>
                                                <br>
                                                <br>
                                                
                                                <div class="form-group">
                                                <label for="file" class="col-md-3 control-label"> Post Anonymously</label>
                                                    <div class="col-md-8">
                                                       
                                                                <input title="Anonymously" type="checkbox" id="anonym"
                                                                    name="anonym">
                                                    
                                                    </div>
                                                </div>
                                                <br>
                                                <br>


                                                

                                            </div>
                                            <br>
                                             <br>
                                            <div class="modal-footer">
                                            <div class="form-group">
                                                   
                                                    <div class="col-md-4">
                                                        <div class="checkbox">
                                                        
                                                            <label>
                                                                <input type="checkbox" name="terms" required> I have read <a
                                                                        href="#" target="_blank">Terms and Conditions</a>

                                                            </label>
                                                        
                                                        </div>

                                                    </div>
                                                </div>
                                                <button class="btn btn-primary pull-right"><i
                                                            class=""></i> Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                <!-- //     </div>
                // </div> -->
            </div>
        </div> <!-- end row -->

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- <div class="panel panel-primary"> -->
                    <!-- <div class="panel-heading">Idea feed</div> -->
                    <div id="postsTable" class="panel-body">
                        @foreach($allIdeas as $posts)

                            <div class="row" id="eachPost{{$posts->id}}">
                                <!-- <div class="col-md-8 col-md-offset-2"> -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><strong>Posted by
                                                @if( !$posts->anonym )
                                                    {{ $posts->user->name }}
                                                @else
                                                    Anonymous
                                                @endif
                                                &nbsp</strong>
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
                                                        Comment</label> <span class="text-sm">Click on idea to view comments </span>
                                                @else

                                                    <label for="" class="label label-primary"> {{count($comments)}}
                                                        Comments</label> <span class="text-sm" >Click on idea to view comments </span>

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

                    </div>
                <!-- </div> -->
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


