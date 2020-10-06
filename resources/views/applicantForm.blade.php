@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mt-3 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white" id="top_div">
                    <h6>Registration Form</h6>
                </div>
                <div class="card-body">
                    <form id="post-form" method="POST" enctype="multipart/form-data" action="javascript:void(0)">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success d-none" id="msg_div">
                                    <span id="res_message"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="alert alert-danger d-none" id="msg_div_err">
                                    <span id="res_message_err"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label><b>Applicant Name</b><span class="text-danger">*</span></label></div>
                                        <div class="col-md-6">
                                            <input type="text" name="name" id="name" placeholder="Enter Applicant Name" class="form-control">
                                            <span class="text-danger p-1" id="nameError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label><b>Email</b><span class="text-danger">*</span></label></div>
                                        <div class="col-md-6">
                                            <input type="text" name="email" placeholder="Enter Email" class="form-control">
                                            <span class="text-danger p-1" id="emailError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label><b>Mailing Adderss</b><span class="text-danger">*</span></label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-1"><label><b>Division</b><span class="text-danger">*</span></label></div>
                                        <div class="col-md-3">
                                            <select name="division_id" id="division" class="form-control">
                                                <option value="0">-- Division --</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger p-1" id="divisionError"></span>
                                        </div>

                                        <div class="col-md-1"><label><b>District</b><span class="text-danger">*</span></label></div>
                                        <div class="col-md-3">
                                            <select name="district_id" id="district" class="form-control">
                                                <option value="0">-- District --</option>
                                            </select>
                                            <span class="text-danger p-1" id="districtError"></span>
                                        </div>

                                        <div class="col-md-1"><label><b>Upazila</b><span class="text-danger">*</span></label></div>
                                        <div class="col-md-3">
                                            <select name="upazila_id" id="upazila" class="form-control">
                                                <option value="0">-- Upazila --</option>
                                            </select>
                                            <span class="text-danger p-1" id="upazilaError"></span>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Address Details</b><span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="3" name="address" placeholder="Enter Address Details"></textarea>
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                </div>
                                <span class="text-danger p-1" id="addressError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label><b>Language Proficiency</b><span class="text-danger">*</span></label></div>
                                        <div class="col-md-7">
                                            <label><input type="checkbox" name="language[]" value="Bangla"> Bangla</label>
                                            <label><input type="checkbox" name="language[]" value="English"> English</label>
                                            <label><input type="checkbox" name="language[]" value="French"> French</label>
                                        </div>
                                        <span style="margin-left: 10px;" class="text-danger p-1" id="languageError"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5"><label><b>Educational Qualification</b></label></div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table class="table table-bordered" id="table1">
                                      <tr>
                                          <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
                                          <!-- <th>S. No</th> -->
                                          <th>Exam.</th>
                                          <th>Institution</th>
                                          <th>Board</th>
                                          <th>Result</th>
                                      </tr>
                                      <tr>
                                          <td style="width:2%;"><input type='checkbox' class='chkbox'/></td>
                                          <td class="w-25">
                                            <select name="degree[]" id="degree_1" class="form-control">
                                                <option value="0">-- Exam. --</option>
                                                @foreach($degrees as $degree)
                                                    <option value="{{ $degree->id }}">{{ $degree->title }}</option>
                                                @endforeach
                                            </select>
                                          </td>
                                          <td class="w-25">
                                            <select name="university[]" id="university_1" class="form-control">
                                                <option value="0">-- Institution --</option>
                                                @foreach($universities as $university)
                                                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                                                @endforeach
                                            </select>
                                          </td>
                                          <td class="w-25">
                                            <select name="board[]" id="board_1" class="form-control">
                                                <option value="0">-- Board --</option>
                                                @foreach($boards as $board)
                                                    <option value="{{ $board->id }}">{{ $board->name }}</option>
                                                @endforeach
                                            </select>
                                          </td>
                                          <td><input class="form-control" type='text' id='result_1' name='result[]'/> </td>
                                        </tr>
                                    </table>
                                    <button type="button" class='btn btn-danger delete'>- Delete</button>
                                    <button type="button" class='btn btn-success addbtn'>+ Add More</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label><b>Photo</b></label></div>
                                        <div class="col-md-6">
                                            <input type="file" name="photo" id="photo" class="form-control">
                                            <span class="text-danger p-1" id="photoError"></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label><b>CV Attachment</b></label></div>
                                        <div class="col-md-6">
                                            <input type="file" name="cv" class="form-control">
                                            <span class="text-danger p-1" id="cvError"></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label><b>Training</b></label></div>
                                        <div class="col-md-9">
                                            <label><input type="radio" id="optselector" name="optselector" value="1"> Yes</label>
                                            <label><input type="radio" id="optselector" name="optselector" value="0"> No</label>

                                                <div id="training_div" style="display:none">
                                                <table class="table2 table-bordered col-md-12" id="table2">
                                                  <tr>
                                                      <th><input class='check_all2' type='checkbox' onclick="select_all2()"/></th>
                                                      <th>Training Name</th>
                                                      <th>Training Details</th>
                                                  </tr>
                                                  <tr>
                                                      <td style="width:4%;"><input type='checkbox' class='chkbox2'/></td>
                                                      <td class="w-25">
                                                        <input class="form-control" type='text' id='training_1' name='training[]'/>
                                                      </td>
                                                      <td class="w-60">
                                                        <textarea class="form-control" rows="1" id='details_1' name="details[]" placeholder="Enter Training Details"></textarea>
                                                      </td>
                                                    </tr>
                                                </table>
                                                <br/>
                                                <button type="button" class='btn btn-danger delete2'>- Delete</button>
                                                <button type="button" class='btn btn-success addbtn2'>+ Add More</button>
                                                </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" id="send_form" class="btn btn-block btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    if ($("#post-form").length > 0) {
        $("#post-form").validate({

            rules: {
                name: {
                    required: true,
                    maxlength: 50
                },
                email: {
                    required: true,
                    maxlength: 250
                }
            },
            messages: {
                name: {
                    required: "Please Enter Name",
                    maxlength: "Your name maxlength should be 50 characters long."
                },
                email: {
                    required: "Please Enter Email",
                    maxlength: "Your email maxlength should be 50 characters long."
                },
            },
            submitHandler: function(form) {
                              
                $('#send_form').html('Sending..');  
                
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: '/applicant' ,
                    type: "POST",
                    data: new FormData(form), //$('#post-form').serialize(),
                    enctype: 'multipart/form-data',
                    cache : false, 
                    processData: false,
                    contentType: false,
                    success: function( response ) {
                        
                        $('#send_form').html('Submit');
                        $('#res_message').show();
                        
                        $('#res_message').html(response.msg);
                        $('#msg_div').removeClass('d-none');

                        document.getElementById("post-form").reset();
                        setTimeout(function(){
                            $('#res_message').hide();
                            $('#msg_div').hide();
                        },10000);

                        $('html, body').animate({
                          scrollTop: $("#top_div").offset().top
                        }, 200);


                        setTimeout(function(){ location.reload(); }, 5000);   
                        

                    },
                    error: function(response) {
                        
                        if(response.responseJSON.errors.name){
                            $('#nameError').text(response.responseJSON.errors.name);
                        } else {
                            $('#nameError').text('');   
                        }

                        if(response.responseJSON.errors.email){
                            $('#emailError').text(response.responseJSON.errors.email);
                        } else {
                            $('#emailError').text('');   
                        }

                        if(response.responseJSON.errors.division_id){
                            $('#divisionError').text(response.responseJSON.errors.division_id);
                        } else {
                            $('#divisionError').text('');   
                        }

                        if(response.responseJSON.errors.district_id){
                            $('#districtError').text(response.responseJSON.errors.district_id);
                        } else {
                            $('#districtError').text('');   
                        }

                        if(response.responseJSON.errors.upazila_id){
                            $('#upazilaError').text(response.responseJSON.errors.upazila_id);
                        } else {
                            $('#upazilaError').text('');   
                        }

                        if(response.responseJSON.errors.address){
                            $('#addressError').text(response.responseJSON.errors.address);
                        } else {
                            $('#addressError').text('');   
                        }

                        if(response.responseJSON.errors.language){
                            $('#languageError').text(response.responseJSON.errors.language);
                        } else {
                            $('#languageError').text('');   
                        }

                        if(response.responseJSON.errors.photo){
                            $('#photoError').text(response.responseJSON.errors.photo);
                        } else {
                            $('#photoError').text('');   
                        }

                        if(response.responseJSON.errors.cv){
                            $('#cvError').text(response.responseJSON.errors.cv);
                        } else {
                            $('#cvError').text('');   
                        }
                     
                   
                        $('#send_form').html('Submit');
                        $('#res_message_err').show();
                        
                        $('#res_message_err').html('Something wrong. Please fix belows and try again');
                        $('#msg_div_err').removeClass('d-none');                       
                        setTimeout(function(){
                            $('#res_message_err').hide();
                            $('#msg_div_err').hide();
                        },20000);


                        $('html, body').animate({
                          scrollTop: $("#top_div").offset().top
                        }, 200);

                   }
                });
            }
        })
    }



    $(document).ready(function () {
           $('#division').change(function () {
             var id = $(this).val();

             $('#district').find('option').not(':first').remove();

             $.ajax({
                url:'divisions/'+id,
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

                             $("#district").append(option);
                        }
                    }
                }
             })
           });

           $('#district').change(function () {
             var id = $(this).val();

             $('#upazila').find('option').not(':first').remove();

             $.ajax({
                url:'districts/'+id,
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

                             $("#upazila").append(option);
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



    $(".delete").on('click', function() {
      $('.chkbox:checkbox:checked').parents("tr").remove();
      $('.check_all').prop("checked", false);
      updateSerialNo();
    });
    var i=$('#table1 tr').length;
    $(".addbtn").on('click',function(){
      count=$('#table1 tr').length;

        var data="<tr><td><input type='checkbox' class='chkbox'/></td>";
          data+="<td><select name='degree[]' id='degree_"+i+"' class='form-control'><option value='0'>-- Exam. --</option>@foreach($degrees as $degree)<option value='{!! $degree->id !!}'>{!! $degree->title !!}</option>@endforeach</select></td>";
          data+="<td><select name='university[]' id='university_"+i+"' class='form-control'><option value='0'>-- Institution --</option>@foreach($universities as $university)<option value='{!! $university->id !!}'>{!! $university->name !!}</option>@endforeach</select></td>";
          data+="<td><select name='board[]' id='board_"+i+"' class='form-control'><option value='0'>-- Board --</option>@foreach($boards as $board)<option value='{!! $board->id !!}'>{!! $board->name !!}</option>@endforeach</select></td>";
          data+="<td><input class='form-control' type='text' id='result_"+i+"' name='result[]'/></td></tr>";
      $('#table1').append(data);
      i++;
    });

    function select_all() {
      $('input[class=chkbox]:checkbox').each(function(){
        if($('input[class=check_all]:checkbox:checked').length == 0){
          $(this).prop("checked", false);
        } else {
          $(this).prop("checked", true);
        }
      });
    }
    function updateSerialNo(){
      obj=$('#table1 tr').find('span');
      $.each( obj, function( key, value ) {
        id=value.id;
        $('#'+id).html(key+1);
      });
    }





    $(".delete2").on('click', function() {
      $('.chkbox2:checkbox:checked').parents("tr").remove();
      $('.check_all2').prop("checked", false);
      updateSerialNo2();
    });
    var i=$('#table2 tr').length;
    $(".addbtn2").on('click',function(){

      count=$('#table2 tr').length;
        var data="<tr><td><input type='checkbox' class='chkbox2'/></td>";
          data+="<td><input class='form-control' type='text' id='training_"+i+"' name='training[]'/></td>";
          data+="<td><textarea class='form-control' rows='1' id='details_"+i+"' name='details[]' placeholder='Enter Training Details'></textarea></td></tr>";
      $('#table2').append(data);
      i++;
    });

    function select_all2() {
      $('input[class=chkbox2]:checkbox').each(function(){
        if($('input[class=check_all2]:checkbox:checked').length == 0){
          $(this).prop("checked", false);
        } else {
          $(this).prop("checked", true);
        }
      });
    }
    function updateSerialNo2(){
      obj=$('#table2 tr').find('span');
      $.each( obj, function( key, value ) {
        id=value.id;
        $('#'+id).html(key+1);
      });
    }




</script>

@endsection
