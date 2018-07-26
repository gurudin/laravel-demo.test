@extends('web.layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-10 offset-1">
      <div class="card">
        <div class="card-header">
          <h3>
            <i class="fa fa-edit"></i> 话题 /
            @if($topics->id)
              编辑话题
            @else
              新建话题
            @endif
          </h3>
        </div>

        <div class="card-body">
          @php
            $action = $topics->id ? route('topics.update', $topics->id): route('topics.store');
          @endphp
          <form action="{{ $action }}" method="POST" accept-charset="UTF-8">
            @csrf

            @if ($topics->id)
              @method('put')
            @endif

            <div class="form-group">
              <label>标题</label>
              <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                value="{{ old('title', $topics->title ) }}"
                placeholder="请填写标题">
              @if ($errors->has('title'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('title') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group">
              <label>分类</label>
              <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id">
                <option value="" hidden disabled {{ $topics->id ? '' : 'selected' }}>请选择分类</option>
                @foreach ($categories as $value)
                  @php
                    $selected = $topics->category_id === $value->id ? 'selected' : '';
                  @endphp
                  <option value="{{ $value->id }}" {{ $selected }}>{{ $value->name }}</option>
                @endforeach
              </select>
              @if ($errors->has('category_id'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('category_id') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group">
              <label>内容</label>
              <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" rows="3"
                placeholder="请填入至少三个字符的内容">{{ old('body', $topics->body ) }}</textarea>
              @if ($errors->has('body'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('body') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6">
                <a class="btn btn-outline-primary" href="{{ route('topics.index') }}">
                  <i class="fa fa-backward"></i> 返回
                </a>
                <button type="submit" class="btn btn-outline-primary">
                  <i class="fa fa-save"></i> 保存
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection