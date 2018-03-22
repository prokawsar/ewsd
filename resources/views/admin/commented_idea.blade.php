@php if( Auth::user()->hasRole('admin'))
    $role = 'layouts.admin';
elseif( Auth::user()->hasRole('coordinator'))
    $role = 'layouts.qacoor';
else
    $role = 'layouts.QAman';
@endphp

@extends($role)
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">5 Most Commented IDEA List</div>
                <div class="panel-body">
                <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Catagory of IDEA</th>
                        <th>Author of IDEA </th>
                        <th>DETAILS </th>
                      </tr>
                      
                      </thead>
                      <tbody>
                        <tr>
                            <td>Campus</td>
                            <td>Pro Kawser</td>
                            <td><a href="{{ url('commented_idea_details')}}">.....</a></td>
                            
                        
                        </tr>                
                    </tbody>
              
                  </table>
               
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
