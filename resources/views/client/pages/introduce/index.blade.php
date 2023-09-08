@extends('client.index')
@section('content')
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <h1 class="page-name">About Us</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">About Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post">
                    <div class="post-content">
                        <p class="content-post">{!! $data['about']->content!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection