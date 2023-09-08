<!-- Main Menu Section -->
<section class="menu">
    <nav class="navbar navigation">
        <div class="container">
            <div class="navbar-header">
                <h2 class="menu-title">Main Menu</h2>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div><!-- / .navbar-header -->

            <!-- Navbar Links -->
            <div id="navbar" class="navbar-collapse collapse text-center">
                <ul class="nav navbar-nav">

                    <!-- Home -->
                    <li class="dropdown ">
                        <a href="{{url('/')}}">Home</a>
                    </li><!-- / Home -->
                    <li class="dropdown dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Category<span
								class="tf-ion-ios-arrow-down"></span></a>
						<div class="dropdown-menu">
							<div class="row">
								<!-- Basic -->
								<div class="col-lg-12 col-md-12 mb-sm-6">
									<ul>
                                        @foreach($data['category'] as $cate)
										<li><a href="{{url('categories/'.urlencode($cate->slug))}}">{{$cate->name}}</a></li>
                                        @endforeach
									</ul>
								</div>

							</div><!-- / .row -->
						</div><!-- / .dropdown-menu -->
					</li><!-- / Elements -->
                    <!-- Home -->
                    <li class="dropdown ">
                        <a href="{{url('blog')}}">Blog</a>
                    </li>
                    <li class="dropdown ">
                        <a href="{{url('introduce')}}">About us</a>
                    </li><!-- / Home -->
                </ul><!-- / .nav .navbar-nav -->

            </div>
            <!--/.navbar-collapse -->
        </div><!-- / .container -->
    </nav>
</section>
