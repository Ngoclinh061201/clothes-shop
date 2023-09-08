@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">About Us</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <a href="{{ url('about-us/create') }}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add item</button></a>
            </div>
        </div>
        
        <?php if (!empty($about)):?>
      
       
            <div class="table-responsive table-responsive-data2 mt-5">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Content</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr-shadow">
                            <td>
                                {!!$about->content!!}
                            </td>
                            <td>
                                {{$about->created_at}}
                                    
                            </td>
                            <td>
                                <button class="btn btn-primary"><a class="text-white" href="{{url('introduce')}}">View
                                        detail</a></button>
                            </td>
                            <td>
                                <div class="table-data-feature">
                                <a href="{{ url('about-us/' . $about->id . '/edit') }}"><button class="item"
                                        data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button></a>
                                    <form action="{{ url('about-us/' . $about->id . '/delete') }}">
                                        
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to delete?')" class="item"
                                            data-toggle="tooltip" data-placement="top" title="Delete" type="submit"><i
                                                class="zmdi zmdi-delete"></i></button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        <tr class="spacer"></tr>
                    </tbody>
            </table>
        <?php endif;?>
        </div>







        <!-- END DATA TABLE -->
    </div>
</div>
@endsection