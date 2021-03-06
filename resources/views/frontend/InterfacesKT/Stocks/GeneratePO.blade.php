@extends('backend.layouts.app')

@section('content')

<script>
    function addindexes(p1)
    {
        var index_table = [p1];
        return p1;
    }
</script>



<!-- New Invoice Starts Here-->

<div class="box box-primary">
    <div class="box-header with-border">

        <div class="col-md-2">
            <h3 class="box-title">Generate Purchase Orders</h3>
            <h5>{{\Carbon\Carbon::now('Asia/Colombo')}}</h5>
        </div>


        <div class="col-md-9">

            {!! Form::open(['class'=>'form', 'url'=>'getsales' , 'method'=>'post']) !!}


            <ul class="list-inline">

                <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit','name'=>'Add')) !!}</li> 
                <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'button','name'=>'modify')) !!}</li>
                <li>{!! Form::button('<span class="glyphicon glyphicon-refresh"> Reset</span>',array('class'=>'btn btn-lg btn-warning','type'=>'reset','name'=>'reset')) !!}</li>
                <li><a class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-print"> Print</span></a></li>
                <li>{!! Form::button('<span class="glyphicon glyphicon-trash"> Delete</span>',array('class'=>'btn btn-lg btn-danger ','type'=>'submit','name'=>'delete')) !!}</li>


            </ul>
        </div>


        <div class="col-md-1">
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div>





    </div><!-- /.box-header -->
    <div class="box-body bg-gray-active">
        <!-- Bill Dislplay here -->

        <div class="row-fluid">
            
            
            <table class="table table-borderless">
                <thead>
                <th>Product Code</th>
                <th>Description</th>
                <th>Current Stock</th>
                <th>Re Order Level</th>
                <th>Action</th>
                </thead>
                
                
                   @foreach($poitems as $poitem)
                <tr>
                   <td>{{$poitem->Pro_Code}}</td>
                   <td>{{$poitem->Pro_Description}}</td>
                   <td>{{$poitem->Pro_Stock}}</td>
                   <td>{{$poitem->Pro_ReorderQty}}</td>
                   <td><button type="submit" class="btn btn-lf btn-primary">GENERATE PO</button></td>
                <tr>
                   @endforeach
                
            </table>

             {{$poitems->links()}}
            
        </div>

        <!-- End Of Bill Display -->
        

        {!! Form::close() !!}   


    </div><!-- /.box-body -->
</div>
<!--box box-success-->



@stop