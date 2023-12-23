@extends('admin.template.master')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">See Customer OrderList</h2>

                            </div>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <!--alert message create-->
                        <div class='col-4 offset-8'>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex">
                        <label for="" class="mt-2 me-2">Orderstatus</label>

                        <select name="status" id="orderstatus" class="form-control col-2">
                            <option value="">All</option>
                            <option value="0">
                                Pending....</option>
                            <option value="1">
                                Success....</option>
                            <option value="2" >
                                Reject....</option>
                        </select>
                    </div>


                    {{-- @if (count($user) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>

                                    <th>User Id</th>
                                    <th>User name</th>
                                    <th>OrderDate</th>
                                    <th>Order Code</th>
                                    <th>TotalPrice</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="ordertable">
                                @foreach ($order as $o)
                                    <tr>

                                        <input type="hidden" id="userid" value="{{ Auth::user()->id }}">
                                        <td class="align-middle">{{ $o->userid }}</td>
                                        <td class="align-middle">{{ $o->username }} || {{$o->id}}</td>

                                        <input type="hidden" value="{{$o->id}}" class="orderid" name="orderid">

                                        <td class="align-middle">{{ $o->created_at->format('F-j-y') }}</td>
                                        <td class="align-middle"> <a href="{{route('item#ordercode',$o->ordercode )}}" class="text-primary">{{ $o->ordercode }}</a> </td>
                                        <td class="align-middle">{{ $o->total_price }}</td>
                                        <td class="align-middle">
                                            <select name="status"  class="form-control statuschange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending....</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Success....</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject....</option>
                                            </select>
                                        </td>



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{ $user->links() }}  --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#orderstatus').change(function() {
                $orderstatus = $('#orderstatus').val();
            //    console.log($orderstatus)
               $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/admin/collection/orderlist',
                    data: {'status' : $orderstatus},
                    dataType: 'json',
                    success: function(response) {

                        $list = '';

                           for ( $i =0 ; $i < response.length ; $i++ ) {
            $month= ['January','February','March','April','May','JUNE','JULY','August','Setember','October','November','December'];
            $dbdate = new Date(response[$i].created_at);
            $date = $month[$dbdate.getMonth()]+"-"+$dbdate.getDate()+"-"+$dbdate.getFullYear();

            //select
            if(response[$i].status == 0) {
                $statusmessage = `
                <select name="status"  class="form-control " id="statuschange">
                    <option value="0" selected>
                        Pending....</option>
                    <option value="1" >
                        Success....</option>
                    <option value="2" >
                        Reject....</option>
                </select>`
            }else if (response[$i].status == 1) {
              $statusmessage = `
              <select name="status"  class="form-control" id="statuschange">
                    <option value="0" >
                        Pending....</option>
                    <option value="1" selected>
                        Success....</option>
                    <option value="2" >
                        Reject....</option>
                </select>`
            }else if ( response[$i].status == 2 ) {
                $statusmessage = `
                <select name="status"  class="form-control" id="statuschange">
                    <option value="0" >
                        Pending....</option>
                    <option value="1" >
                        Success....</option>
                    <option value="2" selected>
                        Reject....</option>
                </select>`
            }
                            $list += `
<tr>
          <input type="hidden" value="${response[$i].id}" class="orderid" name="orderid">

            <td class="align-middle">${response[$i].userid}</td>
            <td class="align-middle">${response[$i].username}</td>

            <td class="align-middle">${$date}</td>
            <td class="align-middle">${response[$i].ordercode}</td>
            <td class="align-middle">${response[$i].total_price}</td>
            <td class="align-middle"> ${$statusmessage} </td>



        </tr>
`;


                           }
                           $('#ordertable').html($list);

                    }
                })


            })//end of change status


            $('.statuschange').change(function() {
                 $status = $(this).val();
                 $orderid = $parentNode.find('.orderid').val();
                // console.log($status);
                // console.log($orderid);

                $status = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderid = $parentNode.find('.orderid').val();
                $data = {
                    'status':$status,
                    'orderid':$orderid,
                }
                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/admin/change/orderstatus',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {
                       console.log(response)
                    }
                })

            })





        })//end
    </script>
@endsection



