@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!--<div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>-->
            <!-- sample start -->
            <div class="card">
              <h5 class="card-header">codemaniac</h5>
              <div class="card-body">
                <!--<h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>-->

                <!--<img src="https://www.jquery-az.com/html/images/banana.jpg" style="height:371.66px; width:600px">-->
                <img src="https://www.jquery-az.com/html/images/banana.jpg" style="height:500px; width:500px">
                <hr>
                <div class="">
                  <i class="fas fa-heart" style="font-size: 18px"></i> &nbsp; <i class="fas fa-comment-alt" style="font-size: 18px"></i><br>
                  <i>Total number of comments</i><br>

                  <span> <strong>username</strong> tag for the picture </span><br>
                  <i>3 comments then a load more comments button. Bold the username of the person posting and the text</i><br>
                  <i>38 MINUTES AGO</i>

                </div>

                <hr>
                <div class="comment">
                  <textarea name="comment" rows="3" cols="80">Add comment...</textarea>
                </div>

              </div>
            </div>
            <!-- sample end -->


            @forelse($posts as $post)

            <div class="card">
              <h5 class="card-header">{{$post->user->username}}</h5>
              <div class="card-body">
                <!--<h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>-->

                <!--<img src="https://www.jquery-az.com/html/images/banana.jpg" style="height:371.66px; width:600px">-->
                <img src="{{route('post-image', ['pic_name' => $post->pic_name] )}}" style="height:500px; width:500px">
                <hr>
                <div class="">
                  <i class="fas fa-heart" style="font-size: 18px"></i> &nbsp; <i class="fas fa-comment-alt" style="font-size: 18px"></i><br>
                  <i>{{$post->comments_count}}</i><br>

                  <span> <strong>{{$post->user->username}}</strong> {{$post->post}} </span><br>
                  <i>3 comments then a load more comments button. Bold the username of the person posting and the text</i><br>
                  <span>38 MINUTES AGO</span>

                </div>

                <hr>
                <div class="comment">
                  <form>
                    <div class="form-group">
                      <textarea class="form-control" rows="3" name="comment"></textarea>
                    </div>

                    <!--<button type="submit" class="btn btn-default">Submit</button>-->
                  </form>
                </div>

              </div>
            </div>

            @empty

              <p>No posts to show for now, please fill in your username and id so our algorithm,
                can pick interesting posts for you.</p>

            @endforelse



        </div>
    </div>
</div>
@endsection
