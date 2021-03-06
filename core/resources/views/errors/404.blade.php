@extends('front.layout')

@section('content')
  <!--   breadcrumb area start   -->
  <div class="breadcrumb-area cases" style="background-image: url('{{asset('assets/front/img/' . $bs->breadcrumb)}}');background-size:cover;">
  <div class="breadcrumb-area contact">
     <div class="container">
        <div class="breadcrumb-txt">
           <div class="row">
              <div class="col-xl-7 col-lg-8 col-sm-10">
                 <span>{{$bs->error_title}}</span>
                 <h1>{{$bs->error_subtitle}}</h1>
                 <ul class="breadcumb">
                    <li><a href="{{route('front.index')}}">Home</a></li>
                    <li>404 Page</li>
                 </ul>
              </div>
           </div>
        </div>
     </div>
    </div>
<div class="breadcrumb-area-overlay"></div>
  </div>
  <!--   breadcrumb area end    -->


  <!--    Error section start   -->
  <div class="error-section">
     <div class="container">
        <div class="row">
           <div class="col-lg-6">
              <div class="not-found">
                 <img src="{{asset('assets/front/img/404.png')}}" alt="">
              </div>
           </div>
           <div class="col-lg-6">
              <div class="error-txt">
                 <div class="oops">
                    <img src="{{asset('assets/front/img/oops.png')}}" alt="">
                 </div>
                 <h2>Parece que te perdiste...</h2>
                 <p>La página que está buscando puede haberse movido, renombrado o puede que nunca haya existido.</p>
                 <a href="{{route('front.index')}}" class="go-home-btn">Devuelveme al inicio</a>
              </div>
           </div>
        </div>
     </div>
  </div>
  <!--    Error section end   -->
@endsection
