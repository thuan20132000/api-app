

@extends('layouts.master')

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th>STT</th>
              <th>Name</th>
              <th>Image</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Discount</th>
              <th>Status</th>
              <th>Setting</th>

          </tr>
        </thead>
        <tfoot>
          <tr>
              <th>STT</th>
              <th>Name</th>
              <th>Image</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Discount</th>
              <th>Status</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($products as $key => $p)
          <tr>
              <td>{{$key}}</td>
              <td>{{$p->name}}</td>
              <td><img src={{ filter_var($p->imageUrl, FILTER_VALIDATE_URL)?$p->imageUrl: asset('upload/image/'.$p->imageUrl) }} width="200px" alt=""/></td>
              <td>{{$p->price}}</td>
              <td>{{$p->stock}}</td>
              <td>{{$p->discount}}</td>
              <td>
                  @if ($p->status == 1)
                     {{"Show"}}
                  @else
                      {{"Hide"}}
                  @endif
              </td>

              <td>
                  <button class="btn-circle btn-sm btn-success editProduct"  data-toggle="modal" data-target="#editModal" data-id={{$p->id}} ><i class="fas fa-edit"></i></button>

                  <button class="btn-circle btn-sm btn-danger deleteProduct" data-toggle="modal" data-target="" data-id={{$p->id}} ><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>

          @endforeach


        </tbody>
      </table>

    </div>
  </div>
</div>


{{--  Edit Modal  --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="padding:20px">

        <form enctype="multipart/form-data"  id="update_form" name="fileInfo">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect1">Category</label>
                    <select name="category" class="form-control form-control @error('category') is-invalid @enderror category" id="exampleFormControlSelect1">
                      <option value="" >Selecting Category...</option>
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
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror name"  >

                      @error('name')
                      <div class="alert">{{ $message }}</div>
                      @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1"> Short Description</label>
                <input name="description" type="text" class="form-control @error('detail') is-invalid @enderror description" >
                @error('short_description')
                <div class="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Price</label>
                  <input name="price" type="text" class="form-control @error('price') is-invalid @enderror price" id="inputEmail4" placeholder="Price">
                  @error('price')
                     <div class="alert">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Discount</label>
                  <input name="discount" type="text" class="form-control @error('discount') is-invalid @enderror discount" id="inputPassword4" placeholder="Discount">
                    @error('discount')
                        <div class="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect1">Colors</label>
                    <select name="color" class="form-control @error('color') is-invalid @enderror color" id="exampleFormControlSelect1" >
                      <option value="">Selecting Color</option>
                      @foreach ($colors as $c)
                         <option value="{{$c->id}}">{{$c->name}}</option>
                      @endforeach

                    </select>
                    @error('color')
                     <div class="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect1">Sizes</label>
                    <select name="size" class="form-control @error('size') is-invalid @enderror size" id="exampleFormControlSelect1" >
                      <option value="">Selecting Size</option>
                      @foreach ($sizes as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
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
                    <input name="stock" type="text" class="form-control @error('stock') is-invalid @enderror stock" >
                    @error('stock')
                    <div class="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    <input name="image" type="file" id="imgInp">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly hidden >

                        </div>
                        @error('image')
                        <div class="alert">{{ $message }}</div>
                        @enderror
                        <div style="width:200px;margin:auto;text-align: center">
                            <img id='img-upload' src="" style="max-width: 180px;text-align: center"/>
                        </div>

                    </div>
                </div>

            </div>

            <label for="exampleFormControlInput1"> Status</label>
            <div class="form-check">
                <input class="form-check-input status" type="radio" name="status" id="exampleRadios1" value="1" checked>
                <label class="form-check-label" for="exampleRadios1">
                 Show
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input status" type="radio" name="status" id="exampleRadios2" value="0">
                <label class="form-check-label" for="exampleRadios2">
                 Hide
                </label>
            </div>
            <div class="form-group" style="width:50%;margin:auto">
                <button style="width:200px" type="button" class="btn btn-success updateProduct" >Update</button>
            </div>

          </form>
      </div>
    </div>
  </div>


@endsection
