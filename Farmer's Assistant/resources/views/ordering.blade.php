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
        var dataProduct =[];
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
        function changeDetect(r, index) {
            var i = r.parentNode.parentNode.rowIndex;
            if (index == 1)
                dataProduct[i - 1].crop = document.getElementById('pName' + i).value;
            else if (index == 2)
                dataProduct[i - 1].type = document.getElementById('sizeInput' + i).value;
            else if (index == 3) {
                dataProduct[i - 1].quantity = document.getElementById('qauntityInput' + i).value;
                document.getElementById('total' + i).innerHTML = Math.ceil(dataProduct[i - 1].quantity * dataProduct[i - 1].price);
            } else if (index == 4) {
                dataProduct[i - 1].price = document.getElementById('priceInput' + i).value;
                document.getElementById('total' + i).innerHTML = Math.ceil(dataProduct[i - 1].quantity * dataProduct[i - 1].price);
            }
        }

        function delete_product(r) {
            var chk = confirm("Are You Sure to Delete This?");
            if (chk) {

                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("hist_table").deleteRow(i);

                dataProduct.splice(i - 1, 1);


            } else {}
        }

        function addStockToCart() {
            var crop = document.getElementById('crop_id').value;
            var type = document.getElementById('type_id').value;
            var quantity = document.getElementById('qty').value;
            var price = document.getElementById('price_id').value;

            if (quantity == "")
                alert("Please specify a quantity");
            else {
                var order = {
                    crop: crop,
                    type: type,
                    quantity: quantity,
                    price: price
                }
                addorder(order,user);//pass user id here
                //console.log(order);
                dataProduct.push(order);
                var sizeRow = dataProduct.length;


                var table = document.getElementById("hist_table");
                var row = table.insertRow(-1);

                var cell1 = row.insertCell(0);
                var cell6 = row.insertCell(1);
                var cell4 = row.insertCell(2);
                var cell2 = row.insertCell(3);
                var cell3 = row.insertCell(4);
                var s = '<button class="btn btn-danger btn-sm" onclick="delete_product(this);"><i class="fa fa-trash-o"></i></button>'

                var cell5 = row.insertCell(5);
                cell1.innerHTML = "<input type='text'  disabled onkeyup='changeDetect(this,1)' id='pName" + sizeRow + "' value='" + crop + "' style='width:100%';>";
                cell6.innerHTML = "<input type='text'  disabled onkeyup='changeDetect(this,2)' id='sizeInput" + sizeRow + "' value='" + type + "' style='width:70%'>";
                cell4.innerHTML = "<input type='number'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='qauntityInput" + sizeRow + "' value='" + quantity + "' style='width:70%'>";
                cell3.innerHTML = "<p id='total" + sizeRow + "'>" + Math.ceil(quantity * price) + "<p>";
                cell5.innerHTML = s;
                cell2.innerHTML = "<input type='number' disabled  onkeyup='changeDetect(this,4)' onclick='changeDetect(this,3)' id='priceInput" + sizeRow + "' value='" + price + "' style='width:70%;'>";
                document.getElementById('crop_id').value = "";
                document.getElementById('type_id').value = "";
                document.getElementById('qty').value = "";
                document.getElementById('price_id').value = "";
            }



        }

        function saveStockData() {

            if (dataProduct.length == 0)
                alert("Please add some product to save data.");
            else {
                var chk = confirm("Are you sure to save all the data in the cart ?");

                if (chk) {
                    var dataImp = {
                        boxID: 5005,
                    }
                    dataProduct.push(dataImp);
                    //Dp.boxID
                    //console.log(dataProduct);

                    $.ajax({
                        data: {
                            data1: dataProduct
                        },
                        url: '/save-order',
                        type: 'POST',

                        beforeSend: function(request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function(response) {
                            // console.log(response);
                            window.location = "/ordering";
                        }
                    });
                }
            }

        }



    </script>

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<?php
echo Session::put('message','');

?>

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


                        <td><input type="number" name="newpaid" id="qty"/></td>

                    </tr>

                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addStockToCart();">Add</button>
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
                            {{--<span class="col-sm-4">--}}
                             {{--<p class="alert text-center" style="color:black; border:1px solid black;">ID:--}}
                            {{--<label id="display_box" class="label" style="font-size:13px; color:red;; border-radious: 10/8px;"> 0 </label>--}}

                              {{--<br>--}}

                             {{--</p></span>--}}


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
