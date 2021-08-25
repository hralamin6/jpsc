
<div>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light py-1 index-forward bg-white">
            <div class="container d-flex justify-content-center justify-content-lg-between align-items-center">
                <a class="navbar-brand" href="index.html"><img src="{{$setup->logo}}" width="100"></a>
                <div>
                    <ul class="list-inline small text-dark d-lg-block">
                        <li class="list-inline-item"><a class="reset-anchor" href="{{$setup->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a class="reset-anchor" href="{{$setup->twitter}}"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a class="reset-anchor" href="{{$setup->youtube}}"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
                <a class="reset-anchor text-small h6 pl-2 d-lg-block" href="mailto:{{$setup->email}}"><i class="far fa-envelope mr-2 text-primary"></i>{{$setup->email}}</a>
                @auth
                <a class="reset-anchor text-small h6 pl-2 d-lg-block" href="{{route('dashboard')}}"><i class="far fa-sign-in mr-2 text-primary"></i>Dashboard</a>
                @else
                <a class="reset-anchor text-small h6 pl-2 d-lg-block" href="{{route('login')}}"><i class="far fa-sign-in mr-2 text-primary"></i>Login</a>
                @endauth
            </div>
        </nav>

    </header>
    <!-- Main post-->
    <section class="bg-white pb-5">
        <div class="container-fluid px-0 pnb-4">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="post-thufmnail"><img class="img-fluid w-100" src="{{asset('frontend')}}/images/jpsc.jpg" alt=""></div>
                </div>
                <div class="col-lg-6 mx-auto text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item m-3"><h2 class="category-link font-weight-normal h2" href="#">About Us</h2></li>
                    </ul>
                    <p class="text-muted">{!!$setup->about!!}</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container py-4">
            <div class="col-md-12 mb-2 mb-lg-0">
                <div class="row">
                    <div class="col-md-6 mb-2">   <a class="d-block post-trending mb-4" href="post.html"><img class="img-fluid w-100" src="{{asset('frontend')}}/images/2.jpg" alt=""/></a></div>
                    <div class="col-md-6 mb-2">   <a class="d-block post-trending mb-4" href="post.html"><img class="img-fluid w-100" src="{{asset('frontend')}}/images/3.jpg" alt=""/></a></div>
                    <div class="col-md-6 mb-2">   <a class="d-block post-trending mb-4" href="post.html"><img class="img-fluid w-100" src="{{asset('frontend')}}/images/4.jpg" alt=""/></a></div>
                    <div class="col-md-6 mb-2">   <a class="d-block post-trending mb-4" href="post.html"><img class="img-fluid w-100" src="{{asset('frontend')}}/images/6.jpg" alt=""/></a></div>
                    <div class="col-md-6 mb-2">   <a class="d-block post-trending mb-4" href="post.html"><img class="img-fluid w-100" src="{{asset('frontend')}}/images/7.jpg" alt=""/></a></div>
                    <div class="col-md-6 mb-2">   <a class="d-block post-trending mb-4" href="post.html"><img class="img-fluid w-100" src="{{asset('frontend')}}/images/8.jpg" alt=""/></a></div>
                    <div class="col-md-6 mb-2">   <a class="d-block post-trending mb-4" href="post.html"><img class="img-fluid w-100" src="{{asset('frontend')}}/images/9.jpg" alt=""/></a></div>
                    <div class="col-md-6 mb-2">   <a class="d-block post-trending mb-4" href="post.html"><img class="img-fluid w-100" src="{{asset('frontend')}}/images/1.jpg" alt=""/></a></div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="contact contact-with-map">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-heading">Get in Touch</h3>
                </div>
                <div class="col-md-4">
                    <div class="contact-data">
                        <ul>
                            <li><span class="timeline-item icon"></span>{{$setup->admin}}</li>
                            <li><span class="ti-mobile icon"></span><a href="tel:{{$setup->phone}}">{{$setup->phone}}</a></li>
                            <li><span class="ti-email icon"></span><a href="mailto:{{$setup->email}}">{{$setup->email}}</a></li>
                            <li><span class="ti-map-alt icon"></span>{{$setup->location}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-md-push-1">
                    <div class="contact-form">
                        <form  class="contact-forms">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" cols="10" rows="2" placeholder="Message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-round btn-g btn btn-primary btn-lg text-center float-right">Submit</button>
                        </form>
                    </div>
                </div>
                <iframe class="py-3" width="100%" height="450" style="border:0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58360.316009764894!2d90.35725884840481!3d23.90664268508803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c4488706e2d9%3A0xee45004fa6ba8d03!2z4Kaf4KaZ4KeN4KaX4KeA!5e0!3m2!1sbn!2sbd!4v1629820035718!5m2!1sbn!2sbd"  allowfullscreen=""></iframe>

            </div>
        </div>

    </section>
    <footer class="py-4" style="background: #111">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-md-4 text-lg-left"><img src="{{$setup->logo}}" width="100"></div>
                <div class="col-md-4 text-center">
                    <div class="d-flex align-items-center flex-wrap justify-content-center">
                        <h6 class="text-muted mb-0 py-2 mr-3">Follow me<span class="ml-3">-</span></h6>
                        <ul class="list-inline small mb-0 text-white">
                            <li class="list-inline-item"><a class="reset-anchor" href="{{$setup->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a class="reset-anchor" href="{{$setup->twitter}}"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="reset-anchor" href="{{$setup->youtube}}"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 text-lg-right">
                    <p class="mb-0 text-muted text-small text-heading">Template designed by <a href="mailto:hralamin2020@gmail.com" class="text-reset">Hr Alamin</a>. </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- JavaScript files-->

</div>

