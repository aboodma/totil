@extends('layouts.backend')
@section('page_header','Payout Request Details')
@section('style')
<style>
    .menu-item {
        color: #000;
        font-size: 14px;
    }

    .active-menu {
        font-weight: bolder;
        color: #d47fa6 !important;
    }
    .timeline {
  list-style-type: none;
  display: flex;
  align-items: center;
  justify-content: center; }

.li {
  transition: all 200ms ease-in; }

.timestamp {
  margin-bottom: 20px;
  padding: 0px 40px;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-weight: 100; }

.status {
  padding: 0px 40px;
  display: flex;
  justify-content: center;
  border-top: 2px solid #D6DCE0;
  position: relative;
  transition: all 200ms ease-in; }
  .status h4 {
    font-weight: 600; }
  .status:before {
    content: '';
    width: 25px;
    height: 25px;
    background-color: white;
    border-radius: 25px;
    border: 1px solid #ddd;
    position: absolute;
    top: -15px;
    left: 42%;
    transition: all 200ms ease-in; }

.li.complete .status {
  border-top: 2px solid #d47fa6; }
  .li.complete .status:before {
    background-color: #d47fa6;
    border: none;
    transition: all 200ms ease-in; }
  .li.reject .status h4 {
    color: red; }
    .li.reject .status {
  border-top: 2px solid red; }
  .li.reject .status:before {
    background-color: red;
    border: none;
    transition: all 200ms ease-in; }
  .li.reject .status h4 {
    color: red; }

    .li.disabled .status h4 {
    color: #acadae; }
    .li.disabled .status {
  border-top: 2px solid #acadae; }
  .li.disabled .status:before {
    background-color: #acadae;
    border: none;
    transition: all 200ms ease-in; }
  .li.disabled .status h4 {
    color: #acadae; }

@media (min-device-width: 320px) and (max-device-width: 700px) {
  .timeline {
    list-style-type: none;
    display: block; }
  .li {
    transition: all 200ms ease-in;
    display: flex;
    width: inherit; }
  .timestamp {
    width: 100px; }
  .status:before {
    left: -8%;
    top: 30%;
    transition: all 200ms ease-in; } }

    .status p {
      margin-top: 16px;
    }
    .title {
      color:#d47fa6;
      font-weight: 800;
    }
    .desc{
      font-weight: 600;
    }
    .gray{
      color:#A3A5A6;
    }





</style>
@endsection
@section('page_toolbar')

@endsection
@section('content')

<div class="content flex-column-fluid" id="kt_content">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
          
            
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    
                   
                    
                    <ul class="timeline" id="timeline">
                      <li class="li complete">
                        <div class="timestamp">
                          
                          
                        </div>
                        <div class="status">
                          <p> {{__('Watting for Admin')}} </p>
                        </div>
                      </li>
                     @if($payoutRequest->status != 3)
                      <li class="li @if( $payoutRequest->status == 1 || $payoutRequest->status == 2) complete @endif">
                        <div class="timestamp">
                     
                          
                        </div>
                        <div class="status">
                          <p> {{__('Request Accepted')}} </p>
                        </div>
                      </li>
                      @else 
                      <li class="li @if( $payoutRequest->status == 3) reject @endif">
                        <div class="timestamp">
                     
                          
                        </div>
                        <div class="status">
                          <p> {{__('Request Rejected')}} </p>
                        </div>
                      </li>
                      @endif
                      <li class="li @if( $payoutRequest->status == 1 || $payoutRequest->status == 2) complete @elseif($payoutRequest->status == 3) disabled @endif">
                        <div class="timestamp">
                     
                          
                        </div>
                        <div class="status">
                          <p class=" @if( $payoutRequest->status == 3) gray @endif"> {{__('In Process')}} </p>
                        </div>
                      </li>
                      <li class="li @if( $payoutRequest->status == 2) complete @elseif($payoutRequest->status == 3) disabled @endif">
                        <div class="timestamp">
                     
                        </div>
                        <div class="status">
                          <p class=" @if( $payoutRequest->status == 3) gray @endif" > {{__('Paid')}} </p>
                        </div>
                      </li>
                     </ul>      
                </div>
                
            </div> <hr>
            <br>

            <div class="row">
              <div class="col-md-12">
                <legend>{{__('Payout Details')}}</legend>

                <div class="row">
                  <div class="col-md-3"><p class="title">{{__('Rquested By :')}}</p> </div>
                  <div class="col-md-6"><p class="desc">{{$payoutRequest->user->name}}</p></div>
                </div>
                <div class="row">
                  <div class="col-md-3"><p class="title">{{__('Amount :')}}</p> </div>
                  <div class="col-md-6"><p class="desc">{{$payoutRequest->amount}}</p></div>
                </div>
                <div class="row">
                  <div class="col-md-3"><p class="title">{{__('Provider Avalibale Ballance  :')}}</p> </div>
                  <div class="col-md-6"><p class="desc">{{$payoutRequest->user->wallets->where('transaction_type',0)->sum('amount') - $payoutRequest->user->wallets->where('transaction_type',1)->sum('amount')}} USD</p></div>
                </div>
                <div class="row">
                  <div class="col-md-3"><p class="title">{{__('Request Date  :')}}</p> </div>
                  <div class="col-md-6"><p class="desc">{{$payoutRequest->created_at}}</p></div>
                </div>
                <hr>
                <div class="row">
                    @if($payoutRequest->status == 0)
                    <div class="col-md-3"><a href="{{route('admin.payouts.accept',$payoutRequest->id)}}" class="btn btn-outline-primary" >Accept</a></div>
                    <div class="col-md-3"><button class="btn btn-outline-danger" data-id="{{$payoutRequest->id}}" data-toggle="modal" data-target="#rejectModal">Reject</button></div>
                    @endif
                    @if($payoutRequest->status == 1)
                    <div class="col-md-3"><button class="btn btn-outline-primary" data-id="{{$payoutRequest->id}}" data-toggle="modal" data-target="#paidModal">Mark As Paid</button></div>
                    @endif
          
                </div>
                
              </div>
            </div>
        </div>
    </div>
</div>
<!--Paid Modal -->
<div class="modal fade" id="paidModal" tabindex="-1" role="dialog" aria-labelledby="paidModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paidModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.payouts.paid')}}" method="POST">
            @csrf
        <div class="modal-body">
            
              <div class="form-group">
                  <label for="">Admin Note</label>
                  <br>
                  <input type="hidden" name="request_id" id="paid_request_id" value=""> 
         
                  <textarea name="admin_note" class="form-control" id="" cols="30" rows="5"></textarea>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Mark As Paid</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  <!--Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectModalLabel">Reject Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.payouts.reject')}}" method="POST">
            @csrf
        <div class="modal-body">
            
              <div class="form-group">
                  <label for="">Admin Note</label>
                  <br>
                  <input type="hidden" name="request_id" id="request_id" value=""> 
                  <small>Please Describe The Reject Reason</small>
                  <textarea name="admin_note" class="form-control" id="" cols="30" rows="5"></textarea>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Reject</button>
        </div>
    </form>

      </div>
    </div>
  </div>
<!--end::Content-->
@endsection


@section('script')

<script>
    $('#rejectModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
 $("#request_id").val(id);
  
})
$('#paidModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
 $("#paid_request_id").val(id);
  
})
</script>
@endsection
