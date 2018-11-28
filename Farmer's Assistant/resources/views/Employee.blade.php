@extends('layouts.app')

@section('content')
    <script>
        function getInfo(r) {
            $.ajax({
                url: '/view-employee/'+r,
                type: 'GET',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response) {
                    document.getElementById("name").value = response.name;
                    document.getElementById("ID").value = response.id;
                    document.getElementById("email").value = response.email;
                    document.getElementById("nic").value = response.nic;
                    document.getElementById("address").value = response.address;
                    document.getElementById("contact").value = response.contact;
                    //document.getElementById("assigned_stock").value = response.assigned_stock;



                }
            });

        }



    </script>
    <h2>
        Employee
        {{--<small>Manage Employee</small>--}}
    </h2>
    <hr class="alert-info">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <?php
    echo Session::put('message','');
    ?>
    @if (session('info'))
        <div class="alert alert-danger">
            {{ session('info') }}
        </div>
    @endif
    <?php
    echo Session::put('info','');
    ?>
    <div class="row">
        @component('components.widget')
            @slot('title')
                Employee
            @endslot
            @slot('description')
                Manage Employee Information
            @endslot
            @slot('body')
                <button class="btn btn-success" data-toggle="modal" data-target="#addSupplyer"><i class="fa fa-plus-square"></i> Add new employee</button>

                <table  id="sTBL" class="table table-bordered table-hover">
                    <thead>
                    <tr>

                        <th><i class="fa fa-sort"></i> ID </th>
                        <th><i class="fa fa-sort"></i> Name</th>
                        <th><i class="fa fa-sort"></i> Email</th>
                        <th><i class="fa fa-sort"></i> NIC</th>
                        <th><i class="fa fa-sort"></i> Address</th>
                        <th><i class="fa fa-sort"></i> Contact</th>
                        <th><i class="fa fa-sort"></i> Assigned Stock</th>
                        <th><i class="fa fa-sort"></i> Status</th>
                        <th><i class=""></i> Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($employee as $employer)
                        <tr>
                            <td>{{ $employer->id}}</td>
                            <td>{{ $employer->name}}</td>
                            <td>{{ $employer->email}}</td>
                            <td>{{ $employer->nic}}</td>
                            <td>{{ $employer->address}}</td>
                            <td>{{ $employer->contact}}</td>

                            @if($employer->assigned_stock==0)
                                <td>Corn</td>
                            @elseif($employer->assigned_stock==1)
                                <td>Wheat</td>
                            @elseif($employer->assigned_stock==2)
                                <td>Potato</td>
                            @elseif($employer->assigned_stock==3)
                                <td>Carrot</td>
                            @else
                                <td>Beetroot</td>
                            @endif

                            @if($employer->publication_status==1)
                                <td>

                                    <label style=""class="switch">
                                        <a href="{{URL::to('/unpublished-employee/'.$employer->id)}}">
                                            <input id="switchMenu" type="checkbox" checked>
                                            <span class="slider round"></span></a>

                                    </label>
                                </td>
                            @else
                                <td>
                                    <label style=""class="switch">
                                        <a href="{{URL::to('/published-employee/'.$employer->id)}}">
                                            <input id="switchMenu" type="checkbox" >
                                            <span class="slider round"></span></a>

                                    </label>

                                </td>
                            @endif
                            <td>

                                <button class="btn btn-sm btn-success" onclick="getInfo('{{$employer->id}}');" data-toggle="modal" data-target="#editEmp"><i class="fa fa-pencil"></i> Edit</button>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

            @endslot
        @endcomponent
    </div>

    <div class="modal fade" id="editEmp">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Employee</h4>
                </div>
                <div class="modal-body">
                    <table  class="table">
                        <form method="POST" action="/update-employee">

                            {{ csrf_field() }}


                            <tbody>
                            <tr>
                                <td></td>
                                <td>Select Assigned Crop :</td>


                                <td><select name="cat" required>
                                        <option value="-1">Select...</option>
                                        <option value="0">Corn</option>
                                        <option value="1">Wheat</option>
                                        <option value="2">Potato</option>
                                        <option value="3">Carrot</option>
                                        <option value="4">Beetroot</option>

                                    </select></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>Name</td>


                                <td><input id="name" name="name" type="text"  required/></td>
                                <input id="ID" name="ID" type="hidden"  required/>


                            </tr>

                            <tr>
                                <td></td>
                                <td>Email</td>


                                <td><input type="text" name="email" id="email" required/></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>NIC</td>


                                <td><input type="text" name="nic" id="nic" required/></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>Address</td>


                                <td><input type="text" name="address" id="address" /></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>Contact</td>


                                <td><input type="number" name="contact" id="contact" required/></td>

                            </tr>
                            <tr>
                                <td></td>

                                <td>
                                    <button type="submit" class="btn btn-success btn-sm">SAVE</button>
                                </td>
                                <td></td>

                            </tr>

                        </form>



                        </tbody>



                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="addSupplyer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Employee</h4>
                </div>
                <div class="modal-body">
                    <table  class="table">
                        <form method="POST" action="/save-employee">
                            {{ csrf_field() }}
                            <tbody>
                            <tr>
                                <td></td>
                                <td>Select Assigned Crop :</td>
                                <td><select name="cat" class="form-control" required>
                                        <option value="-1">Select...</option>
                                        <option value="0">Corn</option>
                                        <option value="1">Wheat</option>
                                        <option value="2">Potato</option>
                                        <option value="3">Carrot</option>
                                        <option value="4">Beetroot</option>
                                    </select></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>Name</td>


                                <td><input type="text" name="name" required/></td>

                            </tr>


                            <tr>
                                <td></td>
                                <td>Email</td>


                                <td><input type="text" name="email" required/></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>NIC</td>


                                <td><input type="text" name="nic" required/></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>Address</td>


                                <td><input type="text" name="address" /></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>Contact</td>


                                <td><input type="number" name="contact" required/></td>

                            </tr>

                            <tr>
                                <td></td>

                                <td>
                                    <button type="submit" class="btn btn-success btn-sm">SAVE</button>
                                </td>
                                <td></td>

                            </tr>

                        </form>



                        </tbody>



                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        $(function () {

            $('#sTBL').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        })
    </script>


@endsection
