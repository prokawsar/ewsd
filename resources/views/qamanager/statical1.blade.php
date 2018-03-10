@extends('layouts.master')

@section('content')
<section class="content-header">
      <h1>
        Discount
        <small>percentage</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Discount</li>
      </ol>
    </section>

    <!-- Main content -->
	
	<section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Discount records</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped">
                <thead>
                <tr>
                  <tr>
						
						<th>Depertment Name</th>
						<th>Number of IDEA</th>
						<th>Number of Contributor </th>
						<th>Sharing Percentage</th>
					</tr>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Science</td>
                        <td><a href="#">10</a></td>
                        <td><a href="#">7</a></td>
                        <td><a href="#">20%</a></td>
                    
                    </tr>                
				</tbody>
				
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
		
      </div>
      <!-- /.row -->
    </section>
	
@endsection
