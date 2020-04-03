@extends('layouts.master')

@section('content')
<div class="container" style="margin-top: 200px">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <form method="POST" action="{{ route('category.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="exampleFormControlInput1"> Name</label>
          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"  >

            @error('name')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Upload Image</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input name="image" type="file" id="imgInp">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly hidden >

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
