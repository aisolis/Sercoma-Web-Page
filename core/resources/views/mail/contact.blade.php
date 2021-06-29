@if ($subsc)
<h4>Hola suscriptor, </h4>
@endif


<p>{!! $text !!}</p>

@if ($subsc)
<p style="margin-botton: 0px;">Saludos,</p>
<p>{{$bs->website_title}}</p>
@endif

