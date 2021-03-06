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
            <h3 class="box-title"> New Quotation </h3>
            <h5>{{\Carbon\Carbon::now('Asia/Colombo')}}</h5>
        </div>


        <div class="col-md-9">

            {!! Form::open(['class'=>'form','url'=>'addquotation','name'=>'myform'])!!}


            <ul class="list-inline">

                <li>{!! Form::button('<span class="glyphicon glyphicon-plus-sign"> Add</span>',array('class'=>'btn btn-lg btn-default','type'=>'submit','name'=>'Add')) !!}</li>
                <li><a class="btn btn-success btn-lg" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-floppy-disk"> Save</span></a></li>
                <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'submit','name'=>'modify')) !!}</li>
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

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Gross Amount: </label>
                    <label class="control-label h4 text-green" id="gross_amount">{{number_format($gross,2,'.',',')}}/-</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Total Discounts: </label>
                    <label class="control-label h4 text-green" id="gross_amount">{{number_format($total_dis,2,'.',',')}}/-</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Total Dis Per: </label>
                    <label class="control-label h4 text-green" id="gross_amount">{{number_format($total_disper,2,'.',',')}}%</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label h4">Net Amount: </label>
                    <label class="control-label h4 text-green" id="gross_amount">{{number_format($net,2,'.',',')}}/-</label>
                </div>
            </div>
        </div>

        <!-- End Of Bill Display -->

        <div class="row-fluid">

           
        </div>
        <script>

            function selectProduct(code)
            {
                var code1 = code.split(",");

                if (code1[3] == 0)
                {
                    alert("Product is Sold out!");
                    document.getElementById('products1').value = "";
                }

                else if (code1[3] > 0)
                {
                    document.getElementById('products1').value = code1[0];
                    document.getElementById('sih').disabled = true;
                }
            }
        </script>



        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Dis%</th>
                    <th>Inv_No</th>
                </tr>
            </thead>

            <tr>
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

                <td>{!! Form::text('products','',['class'=>'form-control input-sm', 'placeholder'=>'Search', 'onkeyup'=>"showHint(this.value)",'size'=>'5' ,'id'=>'products1']) !!}

                    <select class="form-control" id="sih" onchange="selectProduct(this.value)">

                    </select>
                </td>

                <td>
                    {!! Form::number ('Quantity','',['class'=>'form-control input-sm', 'placeholder'=>'Quantity','style'=>'width:5em;']) !!}
                </td>

                <td>
                    {!! Form::text ('dis_per','',['class'=>'form-control input-sm','placeholder'=>'Discount Percentage','style'=>'width:5em;']) !!}
                </td>

                <td>
                    {!! Form::number ('QuotationNo','',['class'=>'form-control input-sm', 'placeholder'=>'Invoice No.','style'=>'width:7em;','id'=>'invoiceid','readonly']) !!}
                </td>
            </tr>
        </table>


        {!! Form::close() !!}       

        <div class="row-fluid">

            <table class="table table-striped">
                <thead>
                <th></th>
                <th>Mode</th>
                <th>Product</th>
                <th>Description</th>
                <th>Invoice No.</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Dis %</th>
                <th>Discount</th>
                <th>Net Amount</th>
                <th>Actions</th>
                </thead>
                <?php $count = 0 ?>
                {!! Form::open(['class'=>'form', 'url'=>'clearqt' , 'method'=>'post']) !!}

                @foreach($temp_qt as $temp_qts)
                <?php $count = $count + 1 ?>
                <tr>   
                <input type="hidden" name="temp_id" value="{{$temp_qts->temp_id}}" />
                <input type="hidden" name="pro_id" value="{{$temp_qts->Product_ID}}" />
                
                <td>{{$count}}</td>
                <td>{{$temp_qts->Salesman}}</td>
                <td>{{$temp_qts->temp_id}}</td>
                <td>{!!$temp_qts->Product_Desc!!}</td>
                
                <td>{{$temp_qts->Product_ID}}</td>
                <td>{{$temp_qts->Price}}</td>
                <td>{{$temp_qts->Dis_Per}}</td>
                <td>{{$temp_qts->Dis_Val}}</td>
                <td>{{$temp_qts->Bill_Dis_Val}}</td>
                <td>{{$temp_qts->Qty}}</td>
                <td>{{$temp_qts->Product_Desc}}</td>
                <td><button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>
                </tr>
                @endforeach

                {!! Form::close() !!}

            </table>

        </div>

    </div><!-- /.box-body -->
</div>
<!--box box-success-->

<!-- New Invoice Ends Here-->


<script type="text/javascript">
    function selecttosave(e1)
    {
        var inid = document.getElementById(e1);
        var val = inid.options[inid.selectedIndex].value;
        window.location = val;
    }
</script>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="panel panel-primary">
                <div class="panel-heading"><h4><center>Please Enter an Invoice Number to Proceed</center></h4></div>
                <div class="panel-body">

                    {!! Form::open(['class'=>'form','url'=>'saveinvoice'])!!}

                    <div class="form-horizontal">

                        <div class="form-group">
                            {!! Form::label ('invoiceno_lbl','Customer ID:',['class' =>'control-label col-md-4']) !!}
                            <div class="col-md-8">
                                {!!Form::text('Customer_ID','',['class'=>'form-control','placeholder'=>'Customer ID Here','onkeyup'=>'getcustomer(this.value)','autofocus'])!!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label ('invoiceno_lbl','Customer :',['class' =>'control-label col-md-4']) !!}
                            <div class="col-md-8">
                                {!! Form::label ('cuscus','',['class' =>'control-label col-md-4','id'=>'Cus_ID']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label ('invoiceno_lbl','Credit Limit:',['class' =>'control-label col-md-4']) !!}
                            <div class="col-md-8">
                                {!! Form::text ('invoiceno_lbl','',['class' =>'col-md-4','id'=>'CreditLimit','onkeyup'=>"checkcredit(this.value)"]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label ('invoiceno_lbl','Please Select An Invoice:',['class' =>'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                <select class="form-control" name="InvoiceNo" id="saves">
                                    @foreach($temp_qt as $temp_qts)
                                    <option value="{{$temp_qts->Quotation_No}}">Invoice No: {{$temp_qts->Quotation_No}} Net Amount : {{number_format($net,2,'.',',')}} </option>
                                    @endforeach
                                </select>
                                <hr>
                            </div>

                        </div>



                        <div class="row-fluid">
                            <div class="form-group">
                                {!! Form::label ('invoiceno_lbl','TAX(VAT) Percentage :',['class' =>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!!Form::text('VAT','',['class'=>'form-control','placeholder'=>'optional'])!!}
                                </div>
                            </div>



                            <label id="test1"></label>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    {!! Form::button('<span class="glyphicon glyphicon-floppy-disk"></span>  Save Invoice',array('class'=>'btn btn-lg btn-success','type'=>'submit','id'=>'saveinvoicebtn')) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-erase"></span>  Clear Fields',array('class'=>'btn btn-lg btn-warning','type'=>'reset')) !!}
                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="panel panel-primary">
                <div class="panel-heading"><h4><center>Please Enter an Invoice Number to Print</center></h4></div>
                <div class="panel-body">

                    {!! Form::open(['class'=>'form','url'=>'printinvoice'])!!}

                    <div class="form-horizontal margin">

                        <div class="form-group">

                            {!! Form::label ('bil_dis_lbl','Invoice Number:',['class' =>'control-label']) !!}
                            <div class="col-md-10 pull-right">
                                {!! Form::text ('Print_ID','',['class'=>'form-control','placeholder'=>'Discount Percentage']) !!}
                            </div>


                        </div>

                    </div>

                </div>
                <div class="panel-footer">
                    {!! Form::button('<span class="glyphicon glyphicon-print"></span>  Print Invoice',array('class'=>'btn btn-lg btn-success','type'=>'submit')) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-erase"></span>  Clear Fields',array('class'=>'btn btn-lg btn-warning','type'=>'reset')) !!}

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
</div>

<script>

            function paycr()
            {
                var cr = "{!!$qt_cr->Qut_No!!}";
                var cr1 = parseInt(cr);
                document.getElementById("invoiceid").value = cr1 + 1;
                //document.getElementById('invoiceid').disabled = true;
            }

            function paycs()
            {
                var cs = "{!!$qt_cs->Qut_No!!}";
                var cs1 = parseInt(cs);
                document.getElementById("invoiceid").value = cs1 + 1;
                //document.getElementById('invoiceid').disabled = true;
            }

            function checkStock()
            {
                var stockval = document.forms["myform"]["sih"].value;
                alert(stockval);
            }
        </script>

<script>
    function showHint(str) {

        document.getElementById('sih').disabled = false;
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    document.getElementById("sih").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getsih/" + str, true);
            xmlhttp.send();
        }
    }

    function getcustomer(str) {
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    var cusdata = this.responseText.split("-");
                    document.getElementById("Cus_ID").innerHTML = cusdata[1];
                    document.getElementById("CreditLimit").value = cusdata[8];

                }
            };
            xmlhttp.open("GET", "getcustomer/" + str, true);
            xmlhttp.send();
        }
    }

    function checkcredit(crd)
    {

        var cr = parseInt(crd);

        if (cr < "{{$net}}".value)
        {
            alert("Sorry Customer Credit is Not Enough");
            document.getElementById("saveinvoicebtn").disabled = true;
        }

        else
        {
            document.getElementById("saveinvoicebtn").disabled = false;
        }

    }
</script>

@stop