@extends('layouts.QAman')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Statistics</div>
                <div class="panel-body">
                
                  <div class="col-md-12 ">
                    <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Depertment Name</th>
                        <th>Number of IDEA</th>
                        <th>Number of Contributor </th>
                        <th>Sharing Percentage</th>
                      </tr>
                      
                      </thead>
                      <tbody>
                        <tr>
                            <td>Science</td>
                            <td><a href="{{ url('/ideas')}}">10</a></td>
                            <td><a href="{{ url('/contributors')}}">7</a></td>
                            <td><a href="{{ url('/percentage')}}">20%</a></td>
                        
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
