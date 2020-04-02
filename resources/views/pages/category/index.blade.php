
@extends('layouts.master')


@section('content')


<div class="card shadow mb-4">

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Image</th>
                <th>Status</th>
                <th></th>

            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Name</th>
              <th>Image</th>
              <th>Status</th>
              <th></th>

            </tr>
          </tfoot>
          <tbody>
            @foreach ($categories as $key => $c)
            <tr>
                <td style="width:50px">{{$key}}</td>
                <td>{{$c->name}}</td>
                <td style="width:120px">
                    <img src="{{$c->imageUrl}}" width="100%"  alt="">
                </td>
                <td style="width:50px">
                    @if ($c->status == 1)
                       {{"Show"}}
                    @else
                        {{"Hide"}}
                    @endif
                </td>

                <td style="width:100px">
                    <button class="btn-circle btn-sm btn-success edit" data-toggle="modal" data-target="#editModal" onclick="updateCategory({{$c->id}})" ><i class="fas fa-edit"></i></button>

                    <button class="btn-circle btn-sm btn-danger delete" data-toggle="modal" data-target="" data-id={{$c->id}} ><i class="fas fa-trash-alt"></i></button>
                </td>
              </tr>

            @endforeach


          </tbody>
        </table>
        <div style="width:100px;margin:auto">
            {{--  {{$categories->links()}}  --}}
        </div>
      </div>
    </div>
  </div>
@endsection
