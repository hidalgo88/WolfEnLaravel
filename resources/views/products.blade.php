@extends('layouts.main')

@section('content')
  <div class="container-fluid">
    <div class="registro">
      <div class="row justify-content-center">
      <a href="{{'products'}}">  <img src="/img/PngLigas/wolf_negro.png" id="logoProducto" alt="LOGO Wolf" width="350px" height="350px"></a>
      </div>

      <div class="busqueda row justify-content-center">
        <div class="col-xs-12 col-sm-6  col-md-6 filtroBusqueda">
          <ul class="nav-item dropdown ulHeader">
            <a class="filtro nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CATEGORIAS - Ligas</a>
            <div class="row">
              <div class="dropdown-menu  col-md-12 justify-content-center" aria-labelledby="navbarDropdownMenuLink">
                @foreach ($leagues as $league)
                  <a class="tipoLetra col-md-6" href="/products/{{$league->id}}">{{ $league->name }}</a><br>
                @endforeach
                <a class="tipoLetra col-md-6" href="{{'/products'}}">Todos los Productos</a>
              </div>

            </div>
          </ul>

        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 filtroBusqueda">
          <form class="" action="" method="get">
            <div class="row">
              <div class="col-xs-9 col-sm-8 col-md-8 search">
                <input type="text" name="name" value="" class="cuadroBusqueda form-control" placeholder="Ingrese una palabra">
              </div>
              <div class="col-xs-3 col-sm-4 col-md-4 search">
                <button type="submit" class="btn btn-block btn-primary botonBusqueda" >Buscar</button>
              </div>
            </div>
          </form>

        </div>

      </div>
      <div class="row justify-content-center">
        @if (session('mensaje'))
          <div class="alert alert-success">
            {{ session('mensaje') }}
          </div>
        @endif
      </div>

      <div class="row justify-content-center">

      @foreach ($products as $product)
        <div class="cajacat1 col-xs-12 col-sm-5 col-md-3">
          <div class="card1 cardCam">
            <div id="ligaIng1" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-interval="10000">
                  <img src="/storage/{{$product->imgProduct}}" class="d-block w-100" alt="CAM MANU FRENTE">
                </div>
              </div>
              {{-- <a class="carousel-control-prev" href="#ligaIng1" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#ligaIng1" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a> --}}
            </div>
          </div>
          <div class="card-body">
              <h5 class="card-title text-center">{{$product->name}}</h5>
              <ul class="list-group">
                <li class="precio text-center">$ {{$product->price}}</li>
                <li class="list-item text-center">LIGA {{$product->league->name}}</li>
                <li class="list-item text-center">MARCA {{$product->brand->name}}</li>
                <li class="precio text-center">TALLE {{$product->size->name}}</li>
                <li class="list-item text-center">DESCRIPCION <br> {{$product->description}}</li>
              </ul>
              <form class="" action="/agregarCarrito" method="post">
                @csrf
                <div class="botonCarrito">
                  <button type="submit" name="product_id"  value="{{$product->id}}" class="btn btn-dark">Agregar al Carro</button>
                </div>
              </form>

              @auth
                @if (Auth::user()->is_admin)
                  <div class="botonCarrito">
                    <a class="btn btn-success" href="/edit/{{$product->id}}">Editar</a>
                  </div>
                @endif
              @endauth


          </div>
        </div>
      @endforeach
      </div>
    </div>
    <div class="row justify-content-center">
      {{$products->links()}}
    </div>
  </div>




@endsection
