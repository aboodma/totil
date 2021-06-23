<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{__('Order Details')}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
  
           
                <table class="table">
                    <tbody>
                        <tr>
                            <td><b>Created At :</b></td>
                            <td>{{$order->created_at->diffForHumans()}}</td>
                        </tr>
                        <tr>
                            <td><b>Expire At :</b></td>
                            <td>{{date('Y-m-d', strtotime($order->created_at. ' + 7 days'))}}</td>
                        </tr>
                        <tr>
                            <td><b>Is Public :</b></td>
                            <td>@if($order->is_public) <i style="font-size:large" class="fas fa-check-circle text-success"></i> @else <i style="font-size:large" class="fas fa-times-circle text-danger"></i> @endif</td>
                        </tr>
                        <tr>
                            <td><b>From :</b></td>
                            <td>{{$order->details->from}}</td>
                        </tr>
                        <tr>
                            <td><b>To :</b></td>
                            <td>{{$order->details->to}}</td>
                        </tr>
                        <tr>
                            <td><b>Customer Name :</b></td>
                            <td>{{$order->user->name}}</td>
                        </tr>
                        <tr>
                            <td><b>Service Name :</b></td>
                            <td>{{$order->service->name}}</td>
                        </tr>
                        <tr>
                            <td><b>Customer Message :</b></td>
                            <td>{{$order->details->customer_message}}</td>
                        </tr>
                        <tr>
                            <td><b>Total Price :</b></td>
                            <td>{{$order->total_price}} USD</td>
                        </tr>
                    </tbody>
                </table>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <a href="{{route('provider.OrderChangeStatus',[1,$order->id])}}" class="btn btn-success">{{__('Accept')}}</a>
    <a href="{{route('provider.OrderChangeStatus',[3,$order->id])}}" class="btn btn-danger">{{__('Reject')}}</a>
  </div>