
<div class="col-md-12">
  <h5><b>{{ucfirst($book->title)}}</b> </h5>
  <p><b>Description :</b>{{$book->description}}</p>
  <p class="pt-3 mb-2"> <b>What do you need ?</b> </p>
  @foreach($book->services as $service)
    <label class="btn btn-outline-success  @if($loop->first) active @endif" >
      <input type="radio" @if($loop->first) checked="checked" @endif class="service_select" style="display: none" id="{{$service->service->id}}"  name="service_id" value="{{$service->service->id}}"  > {{$service->service->name}}
    </label>
    
    @endforeach
    <p> <b>Description : </b> <span id="service_description">* Get The Book With the writer voice</span> </p>
   
    
</div>
@if(!is_null($book->link))
<div class=" col-md-12 pt-3">
   
  <a class="btn  btn-success  btn-xlg form-control rd-in  p-2 mt-3" href="{{$book->link}}" >Buy The Book From Store <i class="fas fa-shopping-cart"></i>  </a>

</div>
@endif
@if($book->video_simple != null)
<div class=" col-md-6 pt-3">
   
  <button class="btn btn-outline-danger pink-btn form-control" type="button" data-toggle="modal" data-target="#Modal">Play Video Samples <i class="fas fa-play"></i>  </button>

</div>
@endif
@if($book->audio_simple != null)
<div class=" col-md-6 pt-3">
   
  <button class="btn btn-outline-danger pink-btn form-control" type="button" data-toggle="modal" data-target="#AudioModal">Play Voice Samples <i class="fas fa-play"></i>  </button>

</div>
@endif


<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="ModalLabel">{{__('Video Sample')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body border-0" id="modal_body">
        
        @if($book->video_simple != null)
        <div class="row">
          <div class="col-md-12">
            <video controls style="width: 100%">
              <source src="{{asset($book->video_simple)}}" type="video/mp4">
            </video>
          </div>
        </div>
        @endif
      </div>
      
    </div>
  </div>
</div>
<div class="modal fade" id="AudioModal" tabindex="-1" role="dialog" aria-labelledby="AudioModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-image: url('{{asset($book->cover_path)}}');background-size:cover;">
      {{-- <div class="modal-header border-0">
        <h5 class="modal-title" id="ModalLabel">{{__(' Voice Sample')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
      <div class="modal-body border-0" style="background-color: #04808b61;height: 500px;" id="modal_body">
        @if($book->audio_simple != null)
        <div class="row" style="margin-top: 70%;">
          <div class="col-md-12">
            <div id="single-song-player">
              <div class="row justify-content-center mb-4">
                <div class="amplitude-play-pause" >
                  <button type="button" class="btn btn-outline-light btn-icon" style="background-color: transparent;
                  height:calc( (3rem * 1.5) + (0.5rem * 2) + (2px) ) !important;
                  width:calc( (3rem * 1.5) + (0.5rem * 2) + (2px) ) !important" id="play-pause">
                    <i class="fa fa-play" style="font-size: 25px;" aria-hidden="true"></i>
                  </button>
              </div>
              </div>
              
            </div>
          </div>
        </div>
      <div class="row">
        <div class="col-md-12">
          <div class=" row justify-content-center mr-0" style="margin-right: 0px;">
            <div class="col-md-12">
            <progress class="amplitude-song-played-progress" id="song-played-progress"></progress>

            </div>
            <div class="col-md-12">
              <div class="row " style="max-width: 100%;">
                <div class="col-md-12 ">
                  <div class="row justify-content-between" style="margin-left: auto;">
                    <span class="current-time">
                      <span class="amplitude-current-minutes"></span>:<span class="amplitude-current-seconds"></span>
                    </span>
                    <span class="duration">
                      <span class="amplitude-duration-minutes"></span>:<span class="amplitude-duration-seconds"></span>
                    </span>
                  </div>
                  
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
        @endif
     
      </div>
      
    </div>
  </div>
</div>


<script>
 Amplitude.init({
    "bindings": {
      37: 'prev',
      39: 'next',
      32: 'play_pause'
    },
    "songs": [
      {
        "name": "Risin' High (feat Raashan Ahmad)",
        "artist": "Ancient Astronauts",
        "album": "We Are to Answer",
        "url": "{{asset($book->audio_simple)}}",
        "cover_art_url": ""
      }
    ]
  });

  window.onkeydown = function(e) {
      return !(e.keyCode == 32);
  };

  /*
    Handles a click on the song played progress bar.
  */
  document.getElementById('song-played-progress').addEventListener('click', function( e ){
    var offset = this.getBoundingClientRect();
    var x = e.pageX - offset.left;

    Amplitude.setSongPlayedPercentage( ( parseFloat( x ) / parseFloat( this.offsetWidth) ) * 100 );
  });

 $(document).ready(function(){
  checkers();
  

           
  $(".service_select").click(function(){
           

           $.ajax({
             url:"{{route('service_check')}}",
             type:"GET",
           data:{service_id:this.id,provider_id:$("#book_id").val()},
             success : function (re) {
                 $(".price").html(re.providerService.price + " USD");
                  $("#service_description").html(re.providerService.service.description)
               
                 $("#price").val(re.providerService.price);
             }
         });
       //    $('#'+this.id).parent().toggleClass('active');
       });
      });

</script>