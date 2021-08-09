@extends('layouts.website')

@section('style')

    <style>
        .liked{
            color: #1ac5d5 !important;
        }
        /*-- Content Style --*/
        .post-footer-option li{
            float:left;
            margin-right:50px;
            padding-bottom:15px;
        }

        .post-footer-option li a{
            color:#AFB4BD;
            font-weight:500;

        }

        .photo-profile{
            border:1px solid #DDD;
        }

        .anchor-username h4{
            font-weight:bold;
        }

        .anchor-time{
            color:#ADB2BB;
            font-size:1.2rem;
        }

        .post-footer-comment-wrapper{
            background-color:#F6F7F8;
        }
    </style>
    @endsection
@section('content')


    <div class="container-fluid">
        @foreach($posts as $post)
            <div class="row justify-content-md-center pt-2 pb-2">
                <div class="col-md-6">
                    <div class="card " >
                        <div class="card-header">
                            <div class="media">
                                <div class="media-left p-2">
                                    <a href="{{route('provider_profile',$post->provider->slug)}}">
                                        <img class="media-object photo-profile" src="{{asset($post->provider->user->avatar)}}" width="40" height="40" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="{{route('provider_profile',$post->provider->slug)}}" class="anchor-username"><h5 class="media-heading">{{$post->provider->user->name}}</h5></a>
                                    <a href="{{route('provider_profile',$post->provider->slug)}}" class="anchor-time">{{$post->created_at->diffForHumans()}}</a>
                                </div>
                            </div>
                        </div>
                        {{--                                        <img class="card-img-top" src="..." alt="Card image cap">--}}
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-text" style="color: {{$post->text_color}}">{{$post->body}}</p>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if($post->file != null && explode('.',$post->file)[1] == "jpg" || explode('.',$post->file)[1] == "png" || explode('.',$post->file)[1] == "webp" ||explode('.',$post->file)[1] == "jpeg" || explode('.',$post->file)[1] == "gif"  )
                                        <img src="{{asset($post->file)}}" style="width:100%" alt="">
                                        @endif
                                        @if($post->file != null && explode('.',$post->file)[1] == "mp4")
                                            <video src="{{asset($post->file)}}" controls></video>
                                        @endif
                                </div>
                            </div>
                            {{--                                            <a href="#" class="btn btn-primary">Go somewhere</a>--}}

                        </div>
                        <section class="post-footer">
                            <hr>
                            <div class="post-footer-option container">
                                <ul class="list-unstyled">
                                    <li><a id="post_{{$post->id}}_15987536912301023487954648" @auth
                                        onclick="toggleLike({{$post->id}})"  href="javascript:void(0)"
                                           @if(\App\ProviderPostLike::where(['user_id'=> auth()->user()->id,'provider_post_id'=>$post->id])->first())
                                           class="liked"
                                           @endif
                                           @endauth
                                            @guest href="{{route('login')}}" @endguest
                                        ><i class="fa fa-thumbs-up"></i> Like</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-comments"></i> Comment</a></li>

                                </ul>
                            </div>

                        </section>
                        <div class="card-body ">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('comment')}}" id="comment_form_{{$post->id}}_022206549874568791" method="post">

                                    <div class="form-group">
                                        <label class="" for="">
                                            Your Comment
                                        </label>
                                        <textarea onkeypress="submiter({{$post->id}});" id="body_{{$post->id}}_54649861321984654"  name="body" style="resize: none; @if($post->background_class != "bg-light" && $post->background_class != "bg-white" && $post->background_class != null) border: none;@endif " class="form-control p-0 m-0 no-fo" id="" cols="30" rows="2"></textarea>
                                        <small class=""> Press enter to submit</small>

                                    </div>

                                </form>
                            </div>
                        </div>
                            <div class="row " id="Commenter_1455_{{$post->id}}">
                                @foreach($post->comments as $comment)


                                    <div class="col-md-12 bg-light border">
                                        <p class="p-0 mb-0">{{$comment->user->name}}</p>

                                        <p>{{$comment->body}}</p>
                                    </div>
                                    <hr>
                                    @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>



    </script>

    @endsection
