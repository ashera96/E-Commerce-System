@extends('layouts.cust-app')

@section('content')
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-database.js"></script> 
<script src="{{ URL::asset('js/firebase/db.js') }}"></script>
<script src="{{ URL::asset('js/firebase/order.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <script>
        var dataToPush = [];
        var row;
        var Supplier_name;

        function getProducts(r, supp, price, qty) {
            dataToPush = [];
            Supplier_name = supp;
            $.ajax({
                url: '/view-stock-details/' + r,
                type: 'GET',
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    var t = $('#productsDetails').DataTable();
                    t.clear().draw();
                    var invoiceDetailsOption =
                        ' <p class="alert " style="color:black; border:1px solid black;"> Purchase ID: <label id="display_ID" class="label" style="font-size:13px; color:red;border:1px solid black; border-radious: 10/8px;">' + r +
                        '</label>\n' +
                        '\n' +
                        '                                      <br><br>\n' +
                        '                                      <label  style="font-size:13px;">Supplier: </label>\n' +
                        '                                      <label id="display_customer" class="label " style="font-size:13px; color:black; "> ' + supp + ' </label><br>\n' +
                        '                                      <label style="font-size:13px;">Total Price: </label>\n' +
                        '                                      <label id="display_price" class="label label-warning" style="font-size:13px; color:black; "> ৳ ' + price + ' </label><br>\n' +

                        '                                      <label style="font-size:13px;">Total Qty: </label>\n' +
                        '                                      <label id="display_price" class="label" style="font-size:13px; color:black; "> ' + qty + ' </label>\n' +
                        '                                  </p>\n' +
                        '\n' +
                        '\n' +
                        '                                 <button class="btn btn-danger" data-toggle="modal" data-target="#invoiceAdd" onclick="checkBoxID(' + r +
                        ')"><i class="fa fa-cart-plus"></i> Add new product to the invoice</button>';
                    document.getElementById("contentInvoice").innerHTML = invoiceDetailsOption;



                    $.each(response, function(i, data) {
                        //console.log(data);

                        var productInfo = {
                            invoiceID: r,
                            pID: data.ID,
                            pName: data.pName,
                            availableQty: data.availableQty,
                            Quantity: data.quantity,
                            salePrice: data.price,
                            size: data.size,
                            styleID: data.styleID,
                            styleName: data.styles.name,
                            brandName: data.brand.name,
                            color: data.color,
                        };
                        dataToPush.push(productInfo);

                        // Action Button
                        var btn = "<button data-toggle=\"modal\" data-target=\"#invoiceModal\" class='btn btn-sm btn-danger' onclick='getParticularSale(" +
                            dataToPush.length + ")'> <i class='fa fa-pencil'></i></button>";

                        t.row.add([
                            data.pName + " ×" + data.quantity,
                            data.availableQty,
                            data.styles.name,
                            data.brand.name,
                            data.price,
                            data.size,
                            data.color,
                            btn

                        ]).draw(true);


                    });


                }
            });

        }


        function checkValidation() {
            var availableQty = document.getElementById("qtyIN").value;
            var Purchase = document.getElementById("qtyINp").value;
            if (parseInt(Purchase) < parseInt(availableQty)) {
                alert("Available quantity can't be greater than purchase quantity");
                document.getElementById("qtyIN").value = dataToPush[row].availableQty;
            }

        }
 
    </script>

    <script>
        // function getInfo(r) {
        //     $.ajax({
        //         url: '/view-employee/'+r,
        //         type: 'GET',
        //         beforeSend: function (request) {
        //             return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        //         },
        //         success: function (response) {
        //             document.getElementById("name").value = response.name;
        //             document.getElementById("ID").value = response.id;
        //             document.getElementById("email").value = response.email;
        //             document.getElementById("nic").value = response.nic;
        //             document.getElementById("address").value = response.address;
        //             document.getElementById("contact").value = response.contact;
        //             //document.getElementById("assigned_stock").value = response.assigned_stock;
        //
        //
        //
        //         }
        //     });
        //
        // }




    </script>

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <?php
    echo Session::put('message', '');
    ?>
        @if (session('info'))
        <div class="alert alert-danger">
            {{ session('info') }}
        </div>
        @endif
        <?php
    echo Session::put('info', '');
    ?>
            <hr class="alert-info">
            <div class="row">
                
                <div class="col-md-7" style="width: 100%">
                    @component('components.widget')
                    @slot('title')Available Stock details
                    @endslot
                    @slot('description') Particular products information
                    <br><br>
                    <input type="text" id="pid"  placeholder="Product name">
                    <input type="button" value="Search" class="btn btn-sm btn-primary" id="submit" onclick="searchstock()">
                    <input type="button" value="Reset" class="btn btn-sm btn-primary" id="reset" onclick="getallstocks()">
                    <span class="col-sm-7" id="contentInvoice">
                       
                              </span><br>
                    @endslot
                    @slot('body')
                    @component('components.table')
                    @slot('tableID') productsDetails
                    @endslot
                    @slot('head')
                    <th><i class="fa fa-sort"></i> Crop</th>
                    <th><i class="fa fa-sort"></i> Type </th>
                    <th><i class="fa fa-sort"></i> Qty Available</th>
                    <th><i class="fa fa-sort"></i> Price </th>

                    <th><i class="fa fa-sort"></i> Produced Date </th>
                    <th><i class="fa fa-sort"></i> Expire Date </th>
                    <th><i class="fa fa-sort"></i> Add to cart </th>

                    <script>getallstocks()</script>
                    
                    @endslot
                    @endcomponent
                    @endslot
                    @endcomponent
                </div>
            </div>

<!-- /.modal -->
<div class="modal fade" id="addPayment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add to cart</h4>
            </div>
            <div class="modal-body">
                <table  class="table">

                    <tbody>
                    <tr>
                        <td></td>
                        <td>Crop</td>


                        <td><input type="text" name="ID" id="crop_id" disabled/></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>Type</td>


                        <td><input type="text" name="amount" id="type_id" disabled/></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>Price per kg</td>


                        <td><input type="number" name="paid" id="price_id" disabled/></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td><label class="control-label">Quantity in kg:</label></td>


                        <td><input type="number" onkeyup="calculatePayment()" name="newpaid" id="amountpaidNew"/></td>

                    </tr>

                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="payToSupplyer();">Pay</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header">

                            <h3 class="widget-user-username">Cart</h3>
                            <h5 class="widget-user-desc">Stock invoice history</h5>
                            <span class="col-sm-4">
                             <p class="alert" style="color:black; border:1px solid black;">ID:
                            <label id="display_box" class="label" style="font-size:13px; color:red;border:1px solid black; border-radious: 10/8px;"> 0 </label>

                              <br>
                              <br>


                            <label class="text-danger" style="font-size:13px;">Supplyer: </label>
                            <label id="display_supplyer" class="label" style="font-size:13px; color:black; "> Not selected </label>
                            <br>
                              <label class="text-danger" style="font-size:13px;">Brand: </label>
                            <label id="display_brand" class="label" style="font-size:13px; color:black; "> Not selected </label>
                           <br>

                            <label class="text-danger" style="font-size:13px;">Style: </label>
                            <label id="display_style" class="label" style="font-size:13px; color:black;border: black 1px solid;border-radius: 10/8px; "> None </label>


                             </p></span>


                        </div>
                        <div class="box-body">

                            <table id="hist_table" class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th><i class="fa fa-sort"></i> Crop </th>
                                    <th><i class="fa fa-sort"></i> Type </th>
                                    <th><i class="fa fa-sort"></i> Qty.</th>
                                    <th><i class="fa fa-sort"></i> Price</th>
                                    <th><i class="fa fa-sort"></i> Total price</th>
                                    <th><i class="fa fa-sort"></i> Action</th>
                                </tr>
                                </thead>
                                <tbody>



                                </tbody>

                            </table>
                            <br>
                            <button class="btn btn-sm btn-danger" onclick="saveStockData()">Save all data</button>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

            

            <script>
                $(function() {
                    $('.select2').select2();

                    $('#productsTBL').DataTable({
                        'paging': true,
                        'lengthChange': false,
                        'searching': true,
                        'ordering': false,
                        'info': true,
                        'autoWidth': true
                    })
                });
                function createCell(cell, text, style) {
                    var div = document.createElement('div'), // create DIV element
                        txt = document.createTextNode(text); // create text node
                    div.appendChild(txt);                    // append text node to the DIV
                    div.setAttribute('class', style);        // set DIV class attribute
                    div.setAttribute('className', style);    // set DIV class attribute for IE (?!)
                    cell.appendChild(div);                   // append DIV to the table cell
                }
                

                function getStyle(ID) {
                    ajaxGet('/get-style', ID);
                    // alert("s");
                }

                function ajaxGet(url, ID) {
                    $.ajax({
                        url: url,
                        type: 'GET',

                        beforeSend: function(request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function(response) {
                            setData(response, styleID, ID);
                        }
                    });
                }

                function setData(getData, id, index) {

                    $(id).empty();
                    $(id).append($('<option>', {
                        value: dataToPush[index].styleID,
                        text: dataToPush[index].styleName,
                    }));
                    $.each(getData, function(i, data) {

                        $(id).append($('<option>', {
                            value: data.id,
                            text: data.name,
                        }));

                    });
                }
            </script>


            @endsection
