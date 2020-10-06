@extends('layouts.appgrid')

@section('content')


<script>


    $(function() {
    
        search_applicant();

        function search_applicant(name='', email='', division_id = '', district_id = '', upazila_id = '')
        {
            var dataTable = $('#applicant_table').DataTable({
                processing: true,
                serverSide: true,
                'sDom': '"top"i',
                "pageLength": 5,
                //searching: false, 
                //paging: false, 
                //info: false,
                ajax:{
                    url: "{{ route('users.index') }}",
                    data:{ name:name, email:email, division_id:division_id, district_id:district_id, upazila_id:upazila_id}
                },
                columns: [
                    {
                        data:'name',
                        name:'name'
                    },
                    {
                        data:'email',
                        name:'email'
                    },
                    {
                        data:'div_name',
                        name:'division'
                    },
                    {
                        data:'dis_name',
                        name:'district'
                    },
                    {
                        data:'upz_name',
                        name:'upazila'
                    },
                    {
                        data:'create_date',
                        name:'create_date',
                        render: function (data) {
                        var date = new Date(data);
                        var month = date.getMonth() + 1;
                        return date.getFullYear()+ "-" + (month.toString().length > 1 ? month : "0" + month) + "-" + date.getDate();
                        }
                    },
                    {   data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false 
                    }
                ]
            });
        }

        $('#filter').click(function(){

            var name = $('#name').val();
            var email = $('#email').val();
            var division_id = $('#division_id').val();
            var district_id = $('#district_id').val();
            var upazila_id = $('#upazila_id').val();
            

            
            //if(division_id != '' &&  division_id != '')
            //{
                $('#applicant_table').DataTable().destroy();
                search_applicant(name, email, division_id, district_id, upazila_id);
            //}
            //else
            //{
                //alert('Select Both filter option');
            //}

        });

        $('#reset').click(function(){
            $('#name').val('');
            $('#email').val('');
            $('#division_id').val('');
            $('#district_id').val('');
            $('#upazila_id').val('');            
            $('#applicant_table').DataTable().destroy();
            search_applicant();
        });


    });
</script>  

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Applicant List</div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                    <br>

                                    <div class="row" style="margin-left: 10px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">

                                                    <div class="col-md-3"><label><b>Applicant Name</b><span class="text-danger">*</span></label></div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="name" id="name" placeholder="Enter Applicant Name" class="form-control">
                                                        <span class="text-danger p-1" id="nameError"></span>
                                                    </div>

                                                    <div class="col-md-1"><label><b>Email</b><span class="text-danger">*</span></label></div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control">
                                                        <span class="text-danger p-1" id="emailError"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-left: 10px;">

                                            <div class="col-md-1"><label><b>Division</b></label></div>
                                            <div class="col-md-3">
                                                <select name="division_id" id="division_id" class="form-control">
                                                    <option value="0">-- Division --</option>
                                                    @foreach($divisions as $division)
                                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger p-1" id="divisionError"></span>
                                            </div>

                                            <div class="col-md-1"><label><b>District</b></label></div>
                                            <div class="col-md-3">
                                                <select name="district_id" id="district_id" class="form-control">
                                                    <option value="0">-- District --</option>
                                                </select>
                                                <span class="text-danger p-1" id="districtError"></span>
                                            </div>

                                            <div class="col-md-1"><label><b>Upazila</b></label></div>
                                            <div class="col-md-3">
                                                <select name="upazila_id" id="upazila_id" class="form-control">
                                                    <option value="0">-- Upazila --</option>
                                                </select>
                                                <span class="text-danger p-1" id="upazilaError"></span>
                                            </div>                                            
                                            
                                    </div>

                                    <div class="row" style="margin-left: 20px;">
                                        <div class="form-group">
                                            <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>

                                            <button type="button" name="reset" id="reset" class="btn btn-default">Reset</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <table id="applicant_table" class="table table-bordered data-table">
                        <thead>
                            <tr>                                
                                <th>Name</th>
                                <th>Email</th>
                                <th>Division</th>
                                <th>District</th>
                                <th>Upazila</th>
                                <th>Insert Date</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

<script>
    
$(document).ready(function () {
          
           $('#division_id').change(function () {
             var id = $(this).val();

             $('#district_id').find('option').not(':first').remove();

             $.ajax({
                url:'divisions_search/'+id,
                type:'get',
                dataType:'json',
                success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>";

                             $("#district_id").append(option);
                        }
                    }
                }
             })
           });

           $('#district_id').change(function () {
             var id = $(this).val();

             $('#upazila_id').find('option').not(':first').remove();

             $.ajax({
                url:'districts_search/'+id,
                type:'get',
                dataType:'json',
                success:function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>";

                             $("#upazila_id").append(option);
                        }
                    }
                }
             })
        });



        $("input[name$='optselector']").click(function() {
            var selection = $(this).val();

            if ( selection == '1')
            {
                $("#training_div").show();
            }
            else if( selection == '0'){
                $("#training_div").hide();
            }
            else
            {
                $("#training_div").hide();
            }

        });

        

 });
</script>

@endsection
