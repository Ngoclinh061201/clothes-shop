@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35">Order</h3>
            <div id='tool' class="tool">
                <form class="form-header" action="{{ url('bill-admin') }}" method="GET">
                    <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas ..." />
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </form>
                <a href="{{ url('bill-admin') }}"> <button class="au-btn--submit bg-danger">reset</button></a>
            </div>

            <div class="table-responsive table-responsive-data2 mt-5">
                <table class="table table-data2">
                    <thead>
                    <tr>
                        <th>Stt</th>
                        <th>User name order</th>
                        <th>User name recipient</th>
                        <th>Number phone</th>
                        <th>City</th>
                        <th>District</th>
                        <th>Address detail</th>
                        <th>Total price</th>
                        <th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($bills as $key => $bill)
                        <tr class="tr-shadow">
                            <td>
                                {{ ++$key }}
                            </td>
                            <td>
                                {{ $bill->userOrder->name }}
                            </td>
                            <td>
                                {{ $bill->recipient_name }}
                            </td>
                            <td>
                                {{$bill->number_phone}}
                            </td>
                            <td>
                                {{$bill->cityBill->name}}
                            </td>
                            <td>
                                {{$bill->districtBill->name}}
                            </td>
                            <td>
                                {{$bill->address_detail}}
                            </td><td>
                                {{$bill->price}}
                            </td>
                            <td>
                                {{$bill->created_at}}
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <form method="POST" action="{{ url('cancel-bill/' . $bill->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to cancel bill ?')"
                                                class="item" data-toggle="tooltip" data-placement="top"
                                                title="Cancel" type="submit"><i class="zmdi zmdi-close"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection
