@extends('layouts')

@section('title', 'Api Documentation2')

@section('content')

	<h2>Olync API Documentation</h2>
    <p>
        This is the documentation for the API for Olync.
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

    <h2>Miscellneous</h2>
    <hr>
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <div class="d-inline p-2 bg-success text-white">GET</div>
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              /states
            </button>
          </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">

            <p>
              Gets a list of all the states in Nigeria.
            </p>

            <h4>
              Response
              <hr>
            </h4>

            <pre>
              [
                  {
                      "state_id": 1,
                      "name": "Abia State"
                  },
                  {
                      "state_id": 2,
                      "name": "Adamawa State"
                  },
                  {
                      "state_id": 3,
                      "name": "Akwa Ibom State"
                  },
                  {
                      "state_id": 4,
                      "name": "Anambra State"
                  },
                  {
                      "state_id": 5,
                      "name": "Bauchi State"
                  },
                  {
                      "state_id": 6,
                      "name": "Bayelsa State"
                  },
                  {
                      "state_id": 7,
                      "name": "Benue State"
                  },
                  {
                      "state_id": 8,
                      "name": "Borno State"
                  },
                  {
                      "state_id": 9,
                      "name": "Cross River State"
                  },
                  {
                      "state_id": 10,
                      "name": "Delta State"
                  },
                  {
                      "state_id": 11,
                      "name": "Ebonyi State"
                  },
                  {
                      "state_id": 12,
                      "name": "Edo State"
                  },
                  ...
              ]
            </pre>

          </div>
        </div>
      </div>
    </div>

    <br>
    <h2>Accounts</h2>
    <hr>

    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingA">
          <h5 class="mb-0">
            <div class="d-inline p-2 bg-primary text-white">POST</div>
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseA" aria-expanded="true" aria-controls="collapseOne">
              /login
            </button>
          </h5>
        </div>

        <div id="collapseA" class="collapse" aria-labelledby="headingA" data-parent="#accordion">
          <div class="card-body">
            <p>
              This allows a corper to login into our application.
            </p>


            <h4>Request <hr> </h4>
<pre>
	{
		'email': 'sahrakhan@gmail.com',
		'password': 'khan@!!',
	}
</pre>

            <h4>Response <hr> </h4>
<pre>
	{
	    "token": "iOiJIUzI1NiJ9dHRwOi8vd3d3Lm9seW5jLm5ldC9vb...",
	    "status_code": 200,
	    "message": "User Authenticated"
	}
</pre>

          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <div class="d-inline p-2 bg-primary text-white">POST</div>
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              /register
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
            <p>
              This allows a new corper to register into the application.
            </p>


            <h4>Request <hr> </h4>
							<pre>
{
	"email":"johndoe@rows.com",
	"password":"password",
	"username":"john_doe",
	"callup_no": "NYSC/VVU/2011/102471"
}
							</pre>

            <h4>Response <hr> </h4>
            <pre>
{
    "token": "iLCJhbGciOiJIUzI1NiJ9.ey...",
    "message": "User created",
    "status_code": 200
}
						</pre>
          </div>
        </div>
      </div>


			<br>
	    <h2>Authenticated Links</h2>
	    <hr>


      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
						<div class="d-inline p-2 bg-success text-white">GET</div>
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              /logout
            </button>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body">
						<p>
              This allows an existing  corper to logout of the application.
            </p>



          </div>
        </div>
      </div>


			<div class="card">
        <div class="card-header" id="headingFour">
          <h5 class="mb-0">
						<div class="d-inline p-2 bg-success text-white">GET</div>
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
              /user-dets
            </button>
          </h5>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
          <div class="card-body">
						<p>
              This returns the corper's details.
            </p>

            <h4>
              Response
              <hr>
            </h4>

            <pre>
{
  "id": 13,
  "name": null,
  "email": "f.falana@dreammesh.ng",
  "username": "fred_falz",
  "gender": null,
  "callup_no": "NYSC/BCU/2011/102471",
  "profile_pic": "default.jpg",
  "state_id_val": null,
  "phone_no": null,
  "short_bio": null,
  "created_at": "2018-02-26 14:21:30",
  "updated_at": "2018-02-26 14:21:30"
}
            </pre>


          </div>
        </div>
      </div>

			<div id="accordion">
	      <div class="card">
	        <div class="card-header" id="heading5">
	          <h5 class="mb-0">
	            <div class="d-inline p-2 bg-primary text-white">POST</div>
	            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseOne">
	              /new-post
	            </button>
	          </h5>
	        </div>

	        <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
	          <div class="card-body">
	            <p>
	              This allows the corper to amke a new post
	            </p>


	            <h4>Request <hr> </h4>
	<pre>
		{
			'post': 'This is me having lunch toady at golden Gate',
			'img': 'img file',
		}
	</pre>

	            <h4>Response <hr> </h4>
	<pre>
{
  "message": "Post creation was succesful!",
  "status_code": "200"
}
	</pre>

	          </div>
	        </div>
	      </div>


				<div class="card">
	        <div class="card-header" id="heading0">
	          <h5 class="mb-0">
							<div class="d-inline p-2 bg-success text-white">GET</div>
	            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse0" aria-expanded="false" aria-controls="collapseThree">
	              /state-posts/{state_id?}
	            </button>
	          </h5>
	        </div>
	        <div id="collapse0" class="collapse" aria-labelledby="heading0" data-parent="#accordion">
	          <div class="card-body">
							<p>
	              This returns all the post of the given state. If no state id is given, it returns all the posts,
								of the current user's state.
	            </p>

	            <h4>
	              Response
	              <hr>
	            </h4>

	            <pre>
{
"data": [
    {
        "id": 34,
        "user_id": "13",
        "post": "This is a post for testing",
        "pic_name": "DC31YOM3ABoXiwysMZUJKfKOXRnUNA2I1bObKh4d.jpeg",
        "likes": "0",
        "created_at": "2018-02-26 15:23:27",
        "updated_at": "2018-02-26 15:23:27",
        "comments_count": "0",
        "liked": false,
        "user": {
            "id": 13,
            "name": null,
            "email": "f.falana@dreammesh.ng",
            "username": "fred_falz",
            "gender": null,
            "callup_no": "NYSC/BCU/2011/102471",
            "profile_pic": "default.jpg",
            "state_id_val": null,
            "phone_no": null,
            "short_bio": null,
            "created_at": "2018-02-26 14:21:30",
            "updated_at": "2018-02-26 14:21:30"
        }
    }
]
}
	            </pre>


	          </div>
	        </div>
	      </div>


				<div class="card">
	        <div class="card-header" id="heading6">
	          <h5 class="mb-0">
							<div class="d-inline p-2 bg-success text-white">GET</div>
	            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapseThree">
	              /user-posts
	            </button>
	          </h5>
	        </div>
	        <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
	          <div class="card-body">
							<p>
	              This returns all the post of the current authenticated user.
	            </p>

	            <h4>
	              Response
	              <hr>
	            </h4>

	            <pre>
{
  "data": [
      {
          "id": 34,
          "user_id": "13",
          "post": "This is a post for testing",
          "pic_name": "DC31YOM3ABoXiwysMZUJKfKOXRnUNA2I1bObKh4d.jpeg",
          "likes": "0",
          "created_at": "2018-02-26 15:23:27",
          "updated_at": "2018-02-26 15:23:27",
          "comments_count": "0",
          "liked": false,
          "user": {
              "id": 13,
              "name": null,
              "email": "f.falana@dreammesh.ng",
              "username": "fred_falz",
              "gender": null,
              "callup_no": "NYSC/BCU/2011/102471",
              "profile_pic": "default.jpg",
              "state_id_val": null,
              "phone_no": null,
              "short_bio": null,
              "created_at": "2018-02-26 14:21:30",
              "updated_at": "2018-02-26 14:21:30"
          }
      }
  ]
}
	            </pre>


	          </div>
	        </div>
	      </div>

				<div class="card">
	        <div class="card-header" id="heading7">
	          <h5 class="mb-0">
							<div class="d-inline p-2 bg-success text-white">GET</div>
	            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapseThree">
	              /post-like/{post_id}
	            </button>
	          </h5>
	        </div>
	        <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
	          <div class="card-body">
							<p>
	              This allows a corper to like a specific post by ID (post_id)
	            </p>

							<h4>Request <hr> </h4>
							<p>
								The <i> <b>post_id:</b> </i> passed in the url.
							</p>

	            <h4>
	              Response
	              <hr>
	            </h4>

	            <pre>
{
  "message": "Action was successful!",
  "status_code": 200
}
	            </pre>


	          </div>
	        </div>
	      </div>


				<div class="card">
	        <div class="card-header" id="heading8">
	          <h5 class="mb-0">
							<div class="d-inline p-2 bg-success text-white">GET</div>
	            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapseThree">
	              /post-like/{post_id}/count
	            </button>
	          </h5>
	        </div>
	        <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion">
	          <div class="card-body">
							<p>
	              This returns the total number of likes for a particular post, after passing the POST ID
	            </p>

							<h4>Request <hr> </h4>
							<p>
								The <i> <b>post_id:</b> </i> passed in the url.
							</p>

	            <h4>
	              Response
	              <hr>
	            </h4>

	            <pre>
{
  "message": "Action was successful!",
  "status_code": 200
}
	            </pre>


	          </div>
	        </div>
	      </div>


				<div class="card">
	        <div class="card-header" id="heading9">
	          <h5 class="mb-0">
							<div class="d-inline p-2 bg-success text-white">GET</div>
	            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapseThree">
	              /post-image/{pic_name}
	            </button>
	          </h5>
	        </div>
	        <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion">
	          <div class="card-body">
							<p>
	              This returns the image of a the post.
	            </p>

							<h4>Request <hr> </h4>
							<p>
								The <i> <b>pic_name:</b> </i> passed in the url.
							</p>

	            <h4>
	              Response
	              <hr>
	            </h4>
								<p>
									An <i> <b>image</b> </i> file.
								</p>

	          </div>
	        </div>
	      </div>

				<div class="card">
	        <div class="card-header" id="heading10">
	          <h5 class="mb-0">
	            <div class="d-inline p-2 bg-primary text-white">POST</div>
	            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse10" aria-expanded="true" aria-controls="collapseOne">
	              /add-comment/{post_id}
	            </button>
	          </h5>
	        </div>

	        <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion">
	          <div class="card-body">
	            <p>
	              This allows the corper add a new comment to a post.
	            </p>


	            <h4>Request <hr> </h4>
							<p>
								The <i> <b>post_id:</b> </i> of the particular post.
							</p>
							<pre>
{
	"comment" : "The text you want to send as a comment."
}
							</pre>

	            <h4>Response <hr> </h4>
							<pre>
{
  "message": "Comment has been added!",
  "status_code": 200
}
							</pre>

	          </div>
	        </div>
	      </div>

				<div class="card">
	        <div class="card-header" id="heading11">
	          <h5 class="mb-0">
							<div class="d-inline p-2 bg-success text-white">GET</div>
	            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapseThree">
	              /post/{post_id}/comments
	            </button>
	          </h5>
	        </div>
	        <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordion">
	          <div class="card-body">
							<p>
	              This returns an object of all the comments of the given POST ID.
	            </p>

							<h4>Request <hr> </h4>
							<p>
								The <i> <b>post_id:</b> </i> passed in the url.
							</p>

	            <h4>
	              Response
	              <hr>
	            </h4>
								<pre>
{
  "status_code": 200,
  "data": [
      {
          "id": 28,
          "user_id": "13",
          "post_id": "34",
          "comment": "This is a comment for th post 34. its posted by osagie and his default account.",
          "created_at": "2018-02-27 13:31:24",
          "updated_at": "2018-02-27 13:31:24",
          "user": {
              "id": 13,
              "name": null,
              "email": "f.falana@dreammesh.ng",
              "username": "fred_falz",
              "gender": null,
              "callup_no": "NYSC/BCU/2011/102471",
              "profile_pic": "default.jpg",
              "state_id_val": null,
              "phone_no": null,
              "short_bio": null,
              "created_at": "2018-02-26 14:21:30",
              "updated_at": "2018-02-26 14:21:30"
          }
      }
  ]
}
								</pre>

	          </div>
	        </div>
	      </div>

				<div class="card">
	        <div class="card-header" id="heading12">
	          <h5 class="mb-0">
	            <div class="d-inline p-2 bg-primary text-white">POST</div>
	            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse12" aria-expanded="true" aria-controls="collapseOne">
	              /update-info
	            </button>
	          </h5>
	        </div>

	        <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordion">
	          <div class="card-body">
	            <p>
	              This updates the information of the current user.
	            </p>


	            <h4>Request <hr> </h4>
							<pre>
{
	"name": "Head Fred",
  "phone_no": "011245718901",
  "state_id_val":"2",
  "gender" : "male",
  "short_bio" : "Software engineer with drive to do more everytime am given an opportunity."
}
							</pre>

	            <h4>Response <hr> </h4>
							<pre>
{
  "message": "successful!!",
  "status_code": 200
}
							</pre>

	          </div>
	        </div>
	      </div>

    </div>

		<br>
		<br>
		<br><br><br>

@endsection
