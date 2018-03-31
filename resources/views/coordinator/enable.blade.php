@section('title', 'Disabled Student Account')

@extends('layouts.qacoor')

@section('content')
<div class="content-wrapper">
    <section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Disabled Student Account</div>

                <div class="panel-body">
                    @php
                        $users = App\User::where('status', 0)->get();

                    @endphp
                    <table id="example1" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>

                        </thead>
                        <tbody>
                        @if( !$users->isEmpty() )
                            @foreach( $users as $user)
                                <tr>
                                    <td>{{ $user->name  }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td><a class="btn btn-success"
                                           href="{{route('enable', ['id' => $user->id])}}">Enable</a>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <td class="warning text-center" colspan="5">No Disabled Account</td>
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection
