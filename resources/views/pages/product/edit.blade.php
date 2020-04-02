

@extends('layouts.master')

@section('content')

<div class="container" style="margin-top: 100px">
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<form method="POST" action="{{ route('product.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleFormControlSelect1">Category</label>
            <select name="category" class="form-control form-control @error('category') is-invalid @enderror" id="exampleFormControlSelect1">
              <option value="" >Selecting Category</option>
              @foreach ($categories as $c)
                <option value={{$c->id}}>{{$c->name}}</option>
              @endforeach
            </select>
            @error('category')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="exampleFormControlInput1"> Name</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}"  >

              @error('name')
              <div class="alert">{{ $message }}</div>
              @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1"> Long Description</label>
        <input name="description" type="text" class="form-control @error('long_description') is-invalid @enderror" value="{{old('description')}}" >
        @error('long_description')
        <div class="alert">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Price</label>
          <input name="price" type="text" class="form-control @error('price') is-invalid @enderror" id="inputEmail4" placeholder="Price" value="{{old('price')}}">
          @error('price')
             <div class="alert">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Discount</label>
          <input name="discount" type="text" class="form-control @error('discount') is-invalid @enderror" id="inputPassword4" placeholder="Discount" value="{{old('discount')}}">
            @error('discount')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleFormControlSelect1">Colors</label>
            <select name="color" class="form-control @error('color') is-invalid @enderror" id="exampleFormControlSelect1">
              <option value="">Selecting Color</option>
                @foreach ($colors as $c)
                    <option value="{{$c->id}}" >{{$c->name}}</option>
                @endforeach
            </select>
            @error('color')
             <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="exampleFormControlSelect1">Sizes</label>
            <select name="size" class="form-control @error('size') is-invalid @enderror" id="exampleFormControlSelect1">
              <option value="">Selecting Size</option>
                @foreach ($sizes as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
            </select>
            @error('size')
             <div class="alert">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleFormControlInput1"> Stock</label>
            <input name="stock" type="text" class="form-control @error('stock') is-invalid @enderror" >
            @error('stock')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Upload Image</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            Browse… <input name="image" type="file" id="imgInp">
                        </span>
                    </span>
                    <input type="text" class="form-control" readonly >

                </div>
                @error('image')
                <div class="alert">{{ $message }}</div>
                @enderror
                <div style="width:300px;margin:auto;text-align: center">
                    <img id='img-upload' style="max-width: 180px;text-align: center"/>
                </div>

            </div>
        </div>

    </div>

    <label for="exampleFormControlInput1"> Status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked>
        <label class="form-check-label" for="exampleRadios1">
         Show
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0">
        <label class="form-check-label" for="exampleRadios2">
         Hide
        </label>
    </div>
    <div class="form-group" style="width:50%;margin:auto">
        <button style="width:200px" type="submit" class="btn btn-success">Create</button>
    </div>

  </form>
</div>

@endsection
