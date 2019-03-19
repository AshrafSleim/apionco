<!DOCTYPE html>
<html lang="en">
<head>
    <title>Firebase Push Notification</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h2>Send Firebase Push Notification | AndroidDeft.Com</h2>
            <hr />
            <form action="{{route('send')}}" method="post">
                <div class="form-group">
                    <label for="send_to">Send To:</label>
                    <select name="send_to" id="send_to"  class="form-control">
                        <option value="sngle">Single Device</option>
                        <option value="topic">Topic</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="firebase_api">Firebase Server API Key:</label>
                    <input type="text" required="" class="form-control" id="firebase_api" placeholder="Enter Firebase Server API Key" name="firebase_api">
                </div>
                <div class="form-group" id="firebase_token_group">
                    <label for="firebase_token">Firebase Token:</label>
                    <input type="text" required="" class="form-control" id="firebase_token" placeholder="Enter Firebase Token" name="firebase_token">
                </div>
                <div class="form-group" style="display: none" id="topic_group">
                    <label for="topic">Topic Name:</label>
                    <input type="text" class="form-control" id="topic" placeholder="Enter Topic Name" name="topic">
                </div>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" required="" class="form-control" id="title" placeholder="Enter Notification Title" name="title">
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea required="" class="form-control" rows="5" id="message" placeholder="Enter Notification Message" name="message"></textarea>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox"id="include_image" name="include_image">Include Image</label>
                </div>
                <div class="form-group" style="display: none" id="image_url_group">
                    <label for="image_url">Image URL:</label>
                    <input type="url" class="form-control" id="image_url" placeholder="Enter Image URL" name="image_url">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" id="include_action" name="include_action">Include Action</label>
                </div>
                <div class="form-group" style="display: none" id="action_group">
                    <label for="action">Action:</label>
                    <select name="action" id="action" class="form-control">
                        <option value="url">Open URL</option>
                        <option value="activity">Open Activity</option>
                    </select>
                </div>
                <div class="form-group" style="display: none" id="action_destination_group">
                    <label for="action_destination">Destination:</label>
                    <input type="text" class="form-control" id="action_destination" placeholder="Enter Destination URL or Activity name" name="action_destination">
                </div>

                <button type="submit" class="btn btn-info">Submit</button>
            </form>

        </div>
        <div class="col-lg-6">


        </div>
    </div>
</div>

<script>
    $('#include_image').change(function(e){
        if($(this).prop("checked")==true){
            $('#image_url_group').show();
            $("#image_url").prop('required',true);
        }else{
            $('#image_url_group').hide();
            $("#image_url").prop('required',false);


        }
    });
    $('#include_action').change(function(e){
        if($(this).prop("checked")==true){
            $('#action_group').show();
            $('#action_destination_group').show();
            $("#action_destination").prop('required',true);
        }else{
            $('#action_group').hide();
            $('#action_destination_group').hide();
            $("#action_destination").prop('required',false);


        }
    });

    $('#send_to').change(function(e){
        var selectedVal = $("#send_to option:selected").val();
        if(selectedVal=='topic'){
            $('#topic_group').show();
            $("#topic").prop('required',true);
            $('#firebase_token_group').hide();
            $("#firebase_token").prop('required',false);
        }else{
            $('#topic_group').hide();
            $("#topic").prop('required',false);
            $('#firebase_token_group').show();
            $("#firebase_token").prop('required',true);
        }
    });
</script>
</body>
</html>