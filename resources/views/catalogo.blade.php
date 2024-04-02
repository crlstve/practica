@extends('layout')


@section('content') 

<h1>Catalogo</h1>
 <div>
     @foreach ($productos as $producto)
         <div>
             <a href="{{ url("catalogo/".$producto->slug) }}">
             {{$producto->title}}
             </a><br>
             {{$producto->excerpt}}
         </div>
         <hr>
     @endforeach
 </div>

 @endsection