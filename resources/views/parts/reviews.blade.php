@php 
function star_replace($string){
    return preg_replace_callback('/[-\w]+/i', function($match){
       $arr = str_split($match[0]);
       $len = count($arr)-1;
       for($i=1;$i<$len;$i++) $arr[$i] = $arr[$i] == '-' ? '-' : '*';
       return implode($arr);
    }, $string);

}

@endphp
<ul class="list-group">
    @foreach($provider->orders->whereIn('id',\App\OrderReview::pluck('order_id')) as $order)
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-5">
                <p><b>{{star_replace($order->user->name)}}</b></p>
                <p>
                <i class="fa fa-star @if($order->rate->rate >= 1) text-warning @endif"></i> 
                <i class="fa fa-star @if($order->rate->rate >= 2) text-warning @endif"></i>
                <i class="fa fa-star @if($order->rate->rate >= 3) text-warning @endif"></i> 
                <i class="fa fa-star @if($order->rate->rate >= 4) text-warning @endif"></i>
                <i class="fa fa-star @if($order->rate->rate == 5) text-warning @endif"></i>
                / <span class="font-weight-bold">{{$order->rate->rate}} {{__('Star')}} </span>    
            </p>
        </div>
            <div class="col-md-8">{{$order->rate->massage}}</div>
        </div>
    </li>

@endforeach


  
  </ul>