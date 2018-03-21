@section('title', 'Contributor of Each Department')

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Number of Contributor each Department</div>
                <div class="panel-body">

                    @php

                    @endphp
                  <div class="col-md-12 ">
                    <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Depertment Name</th>
                        <th>Number of Contributor</th>
                        {{--<th>Sharing Percentage</th>--}}
                      </tr>
                      
                      </thead>
                      <tbody>
                        <tr>
                            <td>Science</td>
                            <td><a href="{{ url('/ideas')}}">10</a></td>
                        
                        </tr>                
                    </tbody>
              
                  </table>
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
