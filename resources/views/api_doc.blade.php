@extends('layouts')

@section('title', 'Api Documentation')

@section('content')

	<h2>Olync API Documentation</h2>
    <p>
        This is the documentation for the API for Olyn.
        Each Accordion below represents endpoints and clicking to expand shows more details about the endpoint.
        Details like the required fields, the JSON format for both request and the JSON format for response.<br>
        <p class="bg-danger text-white" style="padding: 5px;">
        NB: Authenticated links takes the header [ key => Authorization and the value => token]
        </p>
        <br>

        General Validation Response:

        <pre class="bg-danger text-white">
        <code>
            {
                "message": "Validation Error",
                "errors": {
                    "email": [
                        "The email field is required."
                    ],
                    "gender": [
                        "The gender field is required."
                    ],
                    "state_id_val": [
                        "The state id val field is required."
                    ],
                    "phone_no": [
                        "The phone no field is required."
                    ]
                },
                "status_code": 422,
            }
        </code>
        </pre>
    </p>



    <p class="bg-success" style="padding: 4px;">
        <strong><span class="label label-success">Base URL:</span></strong> http://www.olync.net/olyncapi/api
    </p>



		<!-- ending part -->

    <div class="card">
            <div class="card-header">
                <span class="bg-primary text-white" style="padding: 2px;">POST</span>
                /register
            </div>
            <div class="card-body">
                This endpoint makes it possible for you to create a new olync account.
                <hr>
                <table>
                	<thead>
                		<tr></tr>
                	</thead>
                </table>
                <br>
                <strong>Request: </strong>
                <br>
                <pre>
                <code>
                {
                    "username": "jDoe_real",
                    "callup_no": "NYSC/BBCxxx",
                    "password": "password123"
                }
                </code>
                </pre>
                <br>
                <strong>Response: </strong>
                <br>
                <pre>
                <code>
                {
                    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb2x5bmM1NF9hcGkvcHVibGljL2FwaS9yZWdpc3RlciIsImlhdCI6MTUxMzAxNDEzOSwiZXhwIjoxNTEzMjMwMTM5LCJuYmYiOjE1MTMwMTQxMzksImp0aSI6IlBEa0t1dnZqNTBmOFpsVHgiLCJzdWIiOjYsInBydiI6IjdjZjQ4ZjkxZTIyNDAwZmM1OTVlYzg4NmY0ZjVkNTkwIn0.vtsTyUGLdQqghRhrj6K1CynmVKGYOj2rtPy5s5Sa84A",
                    "message": "User created",
                    "status_code": 200
                }
                </code>
                </pre>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <span class="bg-secondary text-white" style="padding: 3px;">GET</span>
                /find-friends/{username}
            </div>
            <div class="card-body">
                This endpoint makes it possible for you to find friends using username.
                <hr>
                <table>
                    <thead>
                        <tr></tr>
                    </thead>
                </table>
                <strong>Request: </strong>
                <pre>
                <code>
                </code>
                </pre>
                <br>
                <strong>Response: </strong>
                <br>
                <pre>
                <code>
                {
                    "status_code": 200,
                    "data": [
                        {
                            "id": 1,
                            "name": "Olakunle Odegbaro",
                            "email": "test@test.com",
                            "username": "killaCam",
                            "gender": "M",
                            "callup_no": "value",
                            "profile_pic": "default.jpg",
                            "state_id_val": 1,
                            "phone_no": "09097694139",
                            "created_at": "2017-06-12 05:04:21",
                            "updated_at": "2017-06-12 05:04:21"
                        },
                        {
                            "id": 2,
                            "name": "Olakunle Odegbaro",
                            "email": "olofin97@gmail.com",
                            "username": "kCam",
                            "gender": "M",
                            "callup_no": "nysc112",
                            "profile_pic": "default.jpg",
                            "state_id_val": 25,
                            "phone_no": "09097694139",
                            "created_at": "2017-07-09 04:54:55",
                            "updated_at": "2017-07-09 04:54:55"
                        }
                    ]
                }
                </code>
                </pre>
            </div>
        </div>

				<!-- start new post -->
				<br>
				<div class="card">
            <div class="card-header">
                <span class="bg-primary text-white" style="padding: 3px;">POST</span>
                /new-post
            </div>
            <div class="card-body">
                This endpoint makes it possible for you to find friends using username.<br>
								<strong>To perform this operation, you must be authenticated.</strong>
                <hr>
                <table>
                    <thead>
                        <tr></tr>
                    </thead>
                </table>
                <strong>Request: </strong>
                <pre>
                <code>
									{
										"post": "string",
										"img": "base 64 encoded data"
									}
                </code>
                </pre>
                <br>
                <strong>Response: </strong>
                <br>
                <pre>
                <code>
									{
	                    "message": "Post creation was succesful!",
	                    "status_code": 200
	                }
                </code>
                </pre>
            </div>
        </div>
				<!-- end new post -->

				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			  <div class="card">
			    <div class="panel-heading" role="tab" id="headingOne">
			      <p class="card-header">
			        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<span class="bg-primary text-white" style="padding: 3px;">POST</span>
                /edit-username
			        </a>
			      </p>
			    </div>
			    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			      <div class="card-body">
							This endpoint makes it possible for you change the current user's username, if it is available.
 						 <hr>
 						 <strong>Request: </strong>
 						 <pre>
 						 <code>
						 {
								 "username" : "k_cam"
						 }
 						 </code>
 						 </pre>
 						 <br>
 						 <strong>Response: </strong>
 						 <br>
 						 <pre>
 						 <code>
 						 {
 								 "status_code": 200,
 								 "message": "successful!!"
 						 }
 						 </code>
 						 </pre>
			      </div>
			    </div>
			  </div>
			</div>

        <br>
        <div class="card">
            <div class="card-header">
                <span class="bg-primary text-white" style="padding: 3px;">POST</span>
                /edit-username
            </div>
            <div class="card-body">
                This endpoint makes it possible for you change the current user's username, if it is available.
                <hr>
                <table>
                    <thead>
                        <tr></tr>
                    </thead>
                </table>
                <strong>Request: </strong>
                <pre>
                <code>
                    {
                        "username" : "k_cam"
                    }
                </code>
                </pre>
                <br>
                <strong>Response: </strong>
                <br>
                <pre>
                <code>
                {
                    "status_code": 200,
                    "message": "successful!!"
                }
                </code>
                </pre>
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-header">
                <span class="bg-primary text-white" style="padding: 3px;">POST</span>
                /update-info
            </div>
            <div class="card-body">
                This endpoint makes it possible for you change the current user's profile detials like their name, phone_no, short_bio, gender and state_id_val.
                <br>
                <strong>NB: name is a required parameter biko.</strong>
                <hr>
                <table>
                    <thead>
                        <tr></tr>
                    </thead>
                </table>
                <strong>Request: </strong>
                <pre>
                <code>
                    {
                        "name" : "Jeremiah Tani",
                        "phone_no" : "09088888",
                        "state_id_val": "",
                        "gender": "",
                        "short_bio": "leo integer malesuada nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis volutpat est"
                    }
                </code>
                </pre>
                <br>
                <strong>Response: </strong>
                <br>
                <pre>
                <code>
                {
                    "status_code": 200,
                    "message": "successful!!"
                }
                </code>
                </pre>
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-header">
                <span class="bg-primary text-white" style="padding: 3px;">POST</span>
                /upload-profile-pic
            </div>
            <div class="card-body">
                This endpoint makes it possible for you change the current user's profile picture.
                <br>
                <strong>NB: name is a required parameter biko.</strong>
                <hr>
                <table>
                    <thead>
                        <tr></tr>
                    </thead>
                </table>
                <strong>Request: </strong>
                <pre>
                <code>
                    {
                        "img" : "Jeremiah Tani"
                    }
                </code>
                </pre>
                <br>
                <strong>Response: </strong>
                <br>
                <pre>
                <code>
                {
                    "status_code": 200,
                    "message": "successful!!"
                }
                </code>
                </pre>
            </div>
        </div>

@endsection
