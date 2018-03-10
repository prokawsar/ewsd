@extends('layouts.master')

@section('content')
<section class="content-header">
      <h1>
        Catagories
        <small>Add</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Add catagories</li>
      </ol>
    </section>

    <!-- Main content -->
	
	<section class="content">
      <div class="row">
        
		<div class="col-md-4">
		<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="" method="POST">
              <div class="form-group">
					<label>Name</label>
  
					  <input type="text" class="form-control " name="name" id="datepicker">
					
					<!-- /.input group -->
				 </div>
				  
                <div class="form-group">
					<label>Date From</label>
  
					  <input type="text" class="form-control " name="dFrom" id="datepicker">
					
					<!-- /.input group -->
				  </div>
				  
				  <div class="form-group">
					<label>Date To</label>
				  
					  <input type="text" class="form-control " name="dTo" id="datepick">
					
					<!-- /.input group -->
				  </div>
				
				<!-- text input -->
                <div class="form-group">
					<label>Final Date</label>
				  
					  <input type="text" class="form-control " name="final" id="datepick">
					
					<!-- /.input group -->
				  </div>

				<div class="form-group">
                  <input type="submit" class="btn btn-flat btn-block btn-success" onclick="return confirm('Are you sure want to add?')" name="add" value="Add" >
                </div>
   
                
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        
      </div>
      <!-- /.row -->
    </section>
	
@endsection
