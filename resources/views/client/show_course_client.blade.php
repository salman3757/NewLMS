@extends('layouts.main')

@section('content')

<div class="container">
    @if(isset($course) && $course)
        <h5>{{$course->name}}</h5>
        <p>{{$course->description}}</p>
        @if(isset($videos))
            @if($videos)
                <div class="d-flex">
                    @foreach($videos as $video)
                        <div class="m-3">
                            <?php   
                                    $url = $video->url;    
                                    $video_id = substr($url, strpos($url, "=") + 1);    
                            ?>
                            <h5>{{$video->name}}</h5>
                            <iframe width="320" height="215"
                            src="https://www.youtube.com/embed/{{$video_id}}" >
                            </iframe>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    @endif
</div>


<!--Comments Section-->
<form action="/create_comment" method="POST" class="container comments p-2 card mt-5">

@csrf

  <div class="mb-3">
    <h3>Comments</h3>
    <textarea name="comment_text" class="form-control" placeholder="Enter your Comments here..."></textarea>
    <input type="hidden" name="course_id" value="{{$course->id}}">
  </div>
  <button type="submit" class="btn btn-info text-light my-3">Post Comment</button>
</form>

<div class="container comments my-5" style="margin-bottom:200px !important">
    @if(isset($comments))
        @if($comments)
            @foreach($comments as $comment)
                <div class="container card p-3 my-2">
                    <h5>
                        {{$comment->client_name}} 
                        <span style="font-size:0.8rem; font-family:courier"> at - {{$comment->created_at}}</span>
                    </h5>
                    <p>
                        {{$comment->comment_text}}
                    </p>
                </div>
            @endforeach
        @endif
    @endif
<div>
@endsection