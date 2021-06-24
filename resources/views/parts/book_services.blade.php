<div class="col-md-12">
  <p><b>{{$book->title}}</b> </p>
  <p><b>Description :</b>{{$book->description}}</p>
  <p> <b>What do you need ?</b> </p>
  @foreach($book->services as $service)
    <label class="btn btn-outline-success  " >
      <input type="radio" class="service_select" style="display: none" id="{{$service->service->id}}"  name="service_id" value="{{$service->service->id}}"  > {{$service->service->name}}
    </label>
    
    @endforeach
    <p> <b>Description : </b> * Get The Book With the writer voice </p>
   
    
</div>
<div class="col-md-12">
   
  <button class="btn btn-primary form-control" type="button" data-toggle="modal" data-target="#Modal">Play Samples <i class="fas fa-play"></i>  </button>

</div>


<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="ModalLabel">{{__('Video & Voice Sample')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body border-0" id="modal_body">
        @if($book->audio_simple != null)
        <div class="row">
          <div class="col-md-12">
            <audio class="form-control"  controls id="audio_{{$book->id}}">
              <source src="{{asset($book->audio_simple)}}" type="audio/mp3">
            </audio> 
          </div>
        </div>
        @endif
        <br>
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
<script>
  // function checkers() {
  //               $("#description_row").hide();
  //               $.ajax({
  //                 url:"{{route('service_check')}}",
  //                 type:"GET",
  //               data:{service_id:$('input[name="service_id"]:checked').val(),provider_id:$("#provider_id").val()},
  //                 success : function (re) {
  //                   $(".price").html(re.providerService.price + " USD");
  //                     $("#description_row").show();
  //                     $("#description").html(re.description);
  //                     $("#price").val(re.providerService.price);
  //                 }
  //             });
  //           }
            
  $(".service_select").click(function(){
           

           $.ajax({
             url:"{{route('service_check')}}",
             type:"GET",
           data:{service_id:this.id,provider_id:$("#book_id").val()},
             success : function (re) {
                 $(".price").html(re.providerService.price + " USD");
        
               
                 $("#price").val(re.providerService.price);
             }
         });
       //    $('#'+this.id).parent().toggleClass('active');
       });

</script>