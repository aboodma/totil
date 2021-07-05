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
   
  <a class="btn btn-outline-danger pink-btn form-control" href="{{$book->link}}" >Buy The Book From Store <i class="fas fa-cart"></i>  </a>

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
    <div class="modal-content" style="background-color: #04808b">
      {{-- <div class="modal-header border-0">
        <h5 class="modal-title" id="ModalLabel">{{__(' Voice Sample')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
      <div class="modal-body border-0" id="modal_body">
        @if($book->audio_simple != null)
        <div class="row">
          <div class="col-md-12">
            <div id="waveform"></div>
            {{-- <audio class="form-control"  controls id="audio_{{$book->id}}">
              <source src="{{asset($book->audio_simple)}}" type="audio/mp3">
            </audio>  --}}
          </div>
        </div>
        @endif
     
      </div>
      
    </div>
  </div>
</div>



<script>
  
 $(document).ready(function(){
  checkers();
  
    // wavesurfer.on('ready', function () {
    //     wavesurfer.play();
    // });
    var wavesurfer = WaveSurfer.create({
              container: '#waveform',
              waveColor: '#D9DCFF',
              progressColor: '#04545B',
              cursorColor: '#4353FF',
              barWidth: 3,
              barRadius: 3,
              cursorWidth: 1,
              height: 100,
              barGap: 2
            
          });
     wavesurfer.load("{{asset($book->audio_simple)}}");

    $("#AudioModal").on('hidden.bs.modal', function () {
            wavesurfer.stop();
        });
        $("#AudioModal").on('show.bs.modal', function () {
          
     wavesurfer.on('ready',function () {
      //  console.log(wavesurfer.isReady);
      wavesurfer.play();
     })
        });
        
        
    });
    
           
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

</script>