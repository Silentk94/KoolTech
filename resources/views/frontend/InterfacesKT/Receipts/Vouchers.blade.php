@extends('backend.layouts.app')

@section('content')

    <script>
        function addindexes(p1)
        {
            var index_table=[p1];
            return p1;
        }
    </script>
   <!-- New Invoice Starts Here-->

    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="col-md-2">
                <h3 class="box-title"> Voucher </h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4>
            </div>


            <div class="col-md-9">

                {!! Form::open(['class'=>'form','url'=>'addvoucher'])!!}


                <ul class="list-inline">
                    
                    <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit','name'=>'save')) !!}</li></li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'submit','name'=>'modify')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-refresh"> Reset</span>',array('class'=>'btn btn-lg btn-warning','type'=>'reset','name'=>'reset')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-print"> Print</span>',array('class'=>'btn btn-lg btn-primary','type'=>'submit','name'=>'print')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-trash"> Delete</span>',array('class'=>'btn btn-lg btn-danger ','type'=>'submit','name'=>'delete')) !!}</li>
                </ul>
            </div>


            <div class="col-md-1">
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box tools -->
            </div>





        </div><!-- /.box-header -->
        <div class="box-body">
            
          
            <table class="table table-borderless table-responsive">
                <thead>
                    <tr>
                        <th>Voucher No.</th>
                        <th>Voucher Mode</th>
                        <th>Amount</th>
                        <th>Customer</th>
                       
                    </tr>
                    
                    <tr>
                        <td>
                            {!! Form::number ('VoucheNo','',['class'=>'form-control input-sm', 'placeholder'=>'Receipt No','readonly']) !!}
                        </td>
                        
                        <td>
                    <div class="form-group">
                    <input type="hidden" id="qtycheck">
                    {!! Form::label ('invoiceno_lbl','Cash:',['class' =>'control-label col-md-2']) !!}
                    <div class="col-md-2">
                        {!!Form::radio('PayType', 'CS', false,['class'=>'radio','onchange'=>'paycs()','autofocus','active'])!!}
                    </div>

                    {!! Form::label ('invoiceno_lbl','Credit:',['class' =>'control-label col-md-2']) !!}
                    <div class="col-md-2">
                        {!!Form::radio('PayType', 'CR', false,['class'=>'radio','onchange'=>'paycr()'])!!}
                    </div>

                </div>
                </td>
                        
                        <td>
                            {!! Form::number ('Amount','',['class'=>'form-control input-sm', 'placeholder'=>'Cheque Amount']) !!}
                        </td>
                        
                        <td>
                            <select  name="CustomerID" class="form-control">
                                @foreach($customers as $customer)
                                    <option value={{$customer->Cus_Code}}>{{$customer->Cus_Code}} - {{$customer->Cus_Name}}</option>
                                @endforeach
                            </select>
                        </td>
                        
                    </tr>
                </thead>
            </table>
            

            {!! Form::close() !!}       

            

            </div>

        </div><!-- /.box-body -->
    </div>
    <!--box box-success-->

    <!-- New Invoice Ends Here-->




    
    
    <script type="text/javascript">
    function selecttosave(e1)
    {
        var inid=document.getElementById(e1);
        var val=inid.options[inid.selectedIndex].value;
        window.location=val;
    }
    </script>
    
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        
        <div class="panel panel-primary">
            <div class="panel-heading">Please Select an Invoice Number to Save</div>
            <div class="panel-body">
 
            </div>
            <div class="panel-footer">
                 <button onclick="selecttosave('saves')" class="btn btn-lg btn-success">Select Invoice</button>
                 
            </div>
        </div>

    </div>
  </div>
</div>

    <!-- Cancel Invoice Ends Here-->
    
    
    

    @stop