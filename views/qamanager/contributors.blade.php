@extends('layouts.QAman')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contributors List</div>
                <div class="panel-body">
                <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Contributor Name</th>
                        <th>Number of Contribution</th>
                        
                      </tr>
                      
                      </thead>
                      <tbody>
                        <tr>
                            <td>Pro Kawser</td>
                            <td><a href="{{ url('/contributor_idea')}}">10</a></td>
                            
                        
                        </tr>                
                    </tbody>
              
                  </table>
               
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
