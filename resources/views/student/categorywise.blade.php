@section('title', 'Category Wise')

@extends('layouts.student')

@section('content')
    <div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @php
               //     $categories = \App\Category::orderBy('cat_name')->get();
                    $total = \App\Category::post_count(); # Working with raw query

                @endphp

                <div class="list-group">
                    <a href="#" class="list-group-item active">
                        All Category
                        <div class="pull-right">
                            Number of ideas
                        </div>
                    </a>

                    <!-- ($categories as $category) -->
                    @foreach($total as $card)
                        <a href="/category/{{$card->cat_name}}" class="list-group-item">{{ $card->cat_name}}
                            <span class="badge badge-success">{{ $card->total}}</span>
                        </a>
                    @endforeach

                </div>

            </div>
        </div>
        </section>
    </div>
@endsection
