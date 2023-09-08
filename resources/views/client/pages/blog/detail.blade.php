@extends('client.index')
@section('content')
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Blog</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">blog</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="post post-single">
					<div class="post-thumb">
						<img class="img-responsive" src="images/blog/blog-post-1.jpg" alt="">
					</div>
					<h2 class="post-title">{{$data['blog']->name}}</h2>
					<div class="post-meta">
						<ul>
							<li>
								<i class="tf-ion-ios-calendar"></i> View: {{$data['blog']->view}}
							</li>
						</ul>
					</div>
					<div class="post-content post-excerpt">
                        {!!( $data['blog']->content) !!}
				    </div>
				    <div class="post-social-share">
				        <h3 class="post-sub-heading">Share this post</h3>
				        <div class="social-media-icons">
				        	<ul>
								<li><a class="facebook" href="https://www.facebook.com/sharer.php?u={{URL::current()}}"><i class="tf-ion-social-facebook"></i></a></li>
							</ul>
				        </div>
				    </div>
				</div> 

			</div>
		</div>
	</div>
</section>
@endsection