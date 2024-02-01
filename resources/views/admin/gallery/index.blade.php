@extends('admin.layout.master')

@section('content')

@if(isset($singleData))

    @php
    $id = $singleData[0]->id;
    $image = $singleData[0]->image;
    $title = $singleData[0]->title;
    $description = $singleData[0]->description;
    $single_status = $singleData[0]->status;
    $btn_text = 'Update';
    $formId = 'editGalleryInfo';
    $url = url('backoffice/gallery/'.$id);
    $method = 'PUT';
    $add_edit_status = 'Edit Gallery';
    @endphp

@else

    @php
    $id = null;
    $image = null;
    $title = null;
    $description = null;
    $single_status = null;
    $btn_text = "Add";
    $formId = 'storeGalleryInfo';
    $url = route('gallery.index');
    $method = 'POST';
    $add_edit_status = 'Gallery list';
    @endphp

@endif


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$data['pageName']}}
        </h1>
        <ol class="breadcrumb">

          @if(isset($singleData))
          <a href="{{route('gallery.index')}}"  class="btn btn-primary btn-sm pull-right" ><i class="fa fa-plus"></i> Add New Gallery</a>
          @else
          <li><a href="#"><i class="fa fa-dashboard"></i> {{$add_edit_status}}</a> </li>
          @endif

      </ol>
    </section>


<!-- Main content -->
<section class="content">

    <div class="row">

      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{$data['pageName']}} lists </h3>
            <button id="sort_save"  type="button" class="btn btn-primary btn-sm pull-right" onClick="saveGalleryPosition();" >Save sort</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <table class="table table-striped text-center" id="Table">
            <thead>
              <tr>
                <th style="width: 5%">#</th>
                <th style="width: 25%">Title</th>
                <th style="width: 20%">Image</th>
                <th style="width: 30%">Description</th>
                <th style="width: 5%">Status</th>
                <th style="width: 10%">Action</th>
            </tr>
        </thead>
        <tbody class="row_position">
            @if(count($lists) > 0)
            @php
            $i=1;
            @endphp
            @foreach($lists as $list)
            <tr id="{!! $list->id !!}">
              <td style="text-align: left !important;">{{$i++}}</td>
              <td style="text-align: left !important;">{{$list->title}}</td>
              <td style="text-align: left !important;"><img height="70" src="{{ asset('media/gallery/'.$list->image) }}"></td>
              <td style="text-align: left !important;">{{$list->description!="" ? $list->description : 'No description'}}</td>
              <td>
                  <div class="switch">
                      <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input" {{ $list->status=='disable' ? '' : 'checked' }} >
                      <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                  </div>
              </td>
              <td>
                <a href="{{ route('gallery.edit',$list->id) }}" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="deleteGallery({!! $list->id !!})" class="btn btn-xs btn-danger del{{$list->id}}"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td colspan="7" class="text-center">No data inserted yet</td>
      </tr>
      @endif
  </tbody>
</table>
</div>
</div>
</div>

<div class="col-md-4">
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">{{$btn_text}} Slider</h3>
    </div>

    {!! Form::open(['url' => $url, 'method' => $method, 'id' => $formId, 'class' => '','files' => 'true','role'=>'form']) !!}


    <div class="box-body row">

        <div class="form-group col-sm-12">
          {!! Form::label('title', 'Title', array('class' => 'control-label')) !!}
          {!! Form::text('title', $title , ['class' => 'form-control','required' => 'required']); !!}
          @if ($errors->has('title'))
          <p class="help-block error_login">
              <strong>{{ $errors->first('title') }}</strong>
          </p>
          @endif
      </div>

      <div class="clearfix"></div>

      <div class="form-group col-sm-12">
          @if($image)
          <img src="{{asset('media/gallery/'.$image)}}" style="width: 100%;">
          @endif
          {!! Form::label('image','Gallery image') !!}  <span class="recommended">Recommended size : 600x400 pixels </span>
          {!! Form::file('image', ['id' => 'image', 'accept' => 'image/*']); !!}
          <small><p class="help-block">Max File size: 1MB</p></small>
          @if ($errors->has('image'))
          <p class="help-block error_login">
              <strong>{{ $errors->first('image') }}</strong>
          </p>
          @endif


      </div>

      <div class="clearfix"></div>


      <div class="form-group col-sm-12">

          {!! Form::label('description', 'Description', array('class' => 'control-label')) !!}
          {!! Form::textarea('description', $description, ['class' => 'form-control textarea']); !!}
          @if ($errors->has('description'))
          <p class="help-block error_login">
              <strong>{{ $errors->first('description') }}</strong>
          </p>
          @endif
      </div>

      <div class="clearfix"></div>


      <div class="form-group col-sm-12">
          {!! Form::label('status', 'Status', array('class' => 'control-label')) !!}
          @php
          $suatus = array('enable'=> 'Enable','disable'=>'Disable');
          @endphp
          {{ Form::select('status', $suatus, $single_status, ['id' => 'status','class' => 'form-control']) }}
          @if ($errors->has('status'))
          <p class="help-block error_login">
              <strong>{{ $errors->first('status') }}</strong>
          </p>
          @endif
      </div>

      <div class="clearfix"></div>


  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-primary pull-right">{{$btn_text}}</button>
</div>

{!! Form::close() !!}
</div>
</div>
</div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('admin/pages/gallery.js') }}"></script>
@endsection