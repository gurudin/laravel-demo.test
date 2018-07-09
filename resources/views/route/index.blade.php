@extends('layouts.app')

@section('content')
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-4 h3">Create Route</div>

      <div class="col-4 text-right"></div>
    </div>
  </div>

  <div class="col-12">
        
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Input routing address">
      <div class="input-group-append">
        <button
          class="btn btn-outline-success"
          type="button">Add Route</button>
      </div>
    </div>

    <div class="list-group" style="height: 600px; overflow: scroll;">

        <li class="list-group-item list-group-item-action">
        1
        <button type="button" class="btn btn-danger btn-sm float-right">
          <i class="fas fa-trash-alt"></i>
        </button>
      </li>

    </div>
    
  </div>
</div>
@endsection
