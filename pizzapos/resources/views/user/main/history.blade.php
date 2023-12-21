@extends('user.utemplate.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('client#page') }}">Home</a>

                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">

        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="datatable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>OrderId</th>
                            <th>TotalPrice</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                            <tr>
                                <input type="hidden" id="userid" value="{{ Auth::user()->id }}">


                                <td class="align-middle">{{ $o->created_at->format('F-j-y') }}</td>
                                <td class="align-middle">{{ $o->ordercode }}</td>
                                <td class="align-middle">{{ $o->total_price }}</td>
                                <td class="align-middle">
                                    @if ($o->status == 0)
                                     <span class="text-warning">Pending.....</span>
                                    @elseif ($o->status == 1)
                                    <span class="text-success">Success.....</span>
                                    @else
                                    <span class="text-danger">Reject.....</span>
                                    @endif
                                </td>



                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>
    <!-- Cart End -->
@endsection




@section('scriptSource')
    <script></script>
@endsection
