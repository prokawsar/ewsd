@extends('layouts.QAman')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">IDEAs without Like</div>
                <div class="panel-body">
                <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Catagory of IDEA</th>
                        <th>Author of Idea</th>
                        <th>Details</th>
                        
                      </tr>
                      
                      </thead>
                      <tbody>
                        <tr>
                            <td>Campus</td>
                            <td>Pro Kawser</td>
                            <td><a href="{{ url('/idea_without_like_details')}}">.....</a></td>
                        
                        </tr>                
                    </tbody>
              
                  </table>
               
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
