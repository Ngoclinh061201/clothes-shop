@extends('admin.index')
@section('content')
    <div class="#">
        <form action="{{ url('about-us/' . $about->id . '/update')  }}" method="post" enctype="multipart/form-data" class="form-horizontal">
          
            @csrf
            <div class="card">
                <div class="card-header">
                    <strong>Add content</strong>
                </div>
                <div class="card-body card-block">                    
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="content" class=" form-control-label">Content</label>
                        </div>
                        <div class="col-12 col-md-9">
                        <textarea id="myeditorinstance" name = "content" > 
                           {{$about->content}}
                        </textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/custom.js') }}"></script>

@endsection