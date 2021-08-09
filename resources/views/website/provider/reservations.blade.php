@extends("layouts.website")

@section("content")
    <div class="main-page second py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @include('parts.provider_sidebar')
                </div>
                <div class="col-lg-8 right">

                    <div class="p-4 bg-white rounded shadow-sm mb-3">
                        <h5 class="mb-4 font-weight-bold text-center">{{__('My Reservations')}}
                        </h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table  table-hover table-bordered">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>{{__('ID')}}</th>
                                            <th>{{__('Provider Name')}}</th>
                                            <th>{{__('Sender Name')}}</th>
                                            <th>{{__('Reservation Date')}}</th>
                                            <th>{{__('Phone')}}</th>
                                            <th>{{__('Reservation Reason')}}</th>
                                            <th>{{__('Massage')}}</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($reservations as $reservation)
                                            <tr>
                                                <td>{{$reservation->id}}</td>
                                                <td nowrap>{{$reservation->Provider->user->name}}</td>
                                                <td nowrap>{{$reservation->User->name}}</td>
                                                <td nowrap>{{$reservation->date}}</td>
                                                <td nowrap>{{$reservation->phone}}</td>
                                                <td >{{$reservation->reservation_reason}}</td>
                                                <td >{{$reservation->msg}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
