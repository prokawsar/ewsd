@extends('layouts.QAman')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 ">
            <div class="panel panel-default">
                <div class="panel-heading">Catagory wise IDEA List</div>
                <div class="panel-body">
                <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Catagory Name</th>
                        <th>Number of IDEA</th>
                      </tr>
                      
                      </thead>
                      <tbody>
                        <tr>
                            <td>Campus</td>
                            <td><a href="{{ url('/catagorys_idea')}}">10</a></td>
                            
                        </tr>                
                    </tbody>
              
                  </table>
               
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
