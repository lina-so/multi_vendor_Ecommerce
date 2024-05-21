 @extends('dashboard.layouts.main')
 @section('title', ' Dashboard')

 @section('breadcrumb')
     @parent
     <li class="breadcrumb-item active">Dashboard</li>
 @endsection

 @section('content')

     <!-- Main content -->
     <div class="content">
         <div class="container-fluid">
             <div class="row">
                <div class="col-lg-3">
                     <div class="card">
                         <div class="card-header bg-blue">
                             <h5 class="m-0">All users</h5>
                         </div>
                         <div class="card-body">
                             <h6 class="card-title">{{ $allUsers }}</h6>
                         </div>
                     </div>
                 </div>

                 <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header bg-blue">
                            <h5 class="m-0">All vendors</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">{{ $allVendors }}</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header bg-blue">
                            <h5 class="m-0">All Orders</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">{{ $allOrders }}</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header bg-blue">
                            <h5 class="m-0">New Orders</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">{{ $newOrders }}</h6>
                        </div>
                    </div>
                </div>
             </div>
             <!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content -->
 @endsection
