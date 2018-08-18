<!doctype html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <style>
        .form-group {
            margin-bottom: 0rem;
        }
    </style>
    <body>
        <div class="container"> 
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                <h3 class="text-center">Enter Demo State Information</h3>
                   <form>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Enter demo_state Name</label>
                        <input type="text" class="form-control state_name"   placeholder="Enter State Name">
                        <span id="state_error_msg" style="color: red"></span>
                      </div>
                       <span id="message" class="text-center"></span><br>
                      <button type="submit" class="btn btn-primary state_name_submit">Submit</button>
                    </form>

                    <h3 class="text-center mt-5">Enter Demo Cities Information</h3>
                    <form>
                      <div class="form-group id='mydiv' ">
                        <label for="exampleInputEmail1">Select demo_state Name</label>
                        <select class="form-control" id="optionsdata">
                            @foreach($options as $option)
                                <option value="{{$option->id}}">{{$option->name}}</option>
                            @endforeach
                        </select>
                      </div>

                       <div class="form-group">
                            <label for="exampleInputEmail1">Enter demo Cities  Name:</label>
                            <input type="text" class="form-control" id="citi_name"   placeholder="Enter Cities Name">
                        </div>
                      <button type="submit" class="btn btn-danger mt-5 citiesinfo">Submit</button>

                    </form>
                </div>
                <div class="col-md-5">
                     <h3 class="text-center mt-3">Selecte Demo State Information</h3>
                    <select name="state" class="form-control" id="choiceoption">
                        @foreach($options as $option)
                                <option value="{{$option->id}}">{{$option->name}}</option>
                        @endforeach
                    </select>


                    <h3 class="text-center mt-5">City Information</h3>
                    <select name="city" class="form-control" id="selectedcity">
                        
                    </select>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>




        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script>
             $(document).ready(function($) {
                 $(document).on('click','.state_name_submit', function(event) {
                    event.preventDefault();
                    var state_name=$('.state_name').val();
                    var token = "{{Session::token()}}";
                    if(state_name){
                        $.ajax({
                            url: '/save_state',
                            type: 'POST',
                            dataType: 'json',
                            data: {name:state_name,_token: token},
                            success:function(data){
                                $('.state_name').val('');
                                var all_stateinfo=data.all_state;
                                var html="";
                                for(var i = 0; i < all_stateinfo.length; i++){
                                  html += '<option value="'+all_stateinfo[i].id+'">'+all_stateinfo[i].name+'</option>';
                                }
                                 $('#optionsdata').empty().append(html);
                                 $('#choiceoption').empty().append(html);
                               
                             }
                        });

                    }else{
                       $('#state_error_msg').text('your State Name is empty');
                    }
                });

                $(document).on('click', '.citiesinfo', function(event) {
                    event.preventDefault();
                    var state_id=$('#optionsdata').val();
                    var citi_name=$('#citi_name').val();
                    var token = "{{Session::token()}}";
                    $.ajax({
                        url: '/save_city',
                        type: 'POST',
                        dataType: 'json',
                        data: {state_id:state_id,name:citi_name,_token: token},
                        success:function(data){
                            $('#citi_name').val("");
                            console.log(data);
                        }
                    });

                });



                $('select[name="state"]').on('change', function(event) {
                    event.preventDefault();
                    var state_id=$('#choiceoption').val();
                    var token = "{{Session::token()}}";
                    if(state_id){
                        $.ajax({
                            url: '/choicebyid',
                            type: 'POST',
                            dataType: 'json',
                            data: {state_id:state_id,_token: token},
                            success:function(data){
                                var optiondataall="";
                                for(var i = 0; i < data.length; i++){
                                  optiondataall += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                                }
                                 $('#selectedcity').empty().append(optiondataall);
                            }
                        });
                    }else{
                        $('select[name="city"').empty();
                    }
                });



             });
        </script>
    </body>
</html>
