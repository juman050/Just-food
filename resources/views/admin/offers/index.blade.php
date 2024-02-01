@extends('admin.layout.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$data['pageName']}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
            <li class="active">{{$data['pageName']}}</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Manage Offers</h3>
                        <button id="sort_save"  type="button" class="btn btn-primary btn-sm pull-right save_sort_left_margin" onClick="saveOfferPosition();" >Save sort</button>
                        <a href="{{action('Backend\OfferController@create')}}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add new offer</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped" id="Table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Banner image</th>
                                    <th>Display in banner</th>
                                    <th>Start-date</th>
                                    <th>End-date</th>
                                    <th>Time start</th>
                                    <th>Time End</th>
                                    <th>Coupon code</th>
                                    <th>Free shipping</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="row_position">
                                @if(count($lists) > 0)
                                @php
                                $i=1;
                                @endphp
                                @foreach($lists as $list)
                                <tr id="{!! $list->id !!}">

                                    <td>{{$i++}}</td>
                                    <td>{{$list->title}}</td>
                                    <td>

                                        @if(($list->banner_image == '') || ($list->banner_image == null))
                                        <p>No image</p>
                                        @else
                                        <img src="{{asset('media/offers/'.$list->banner_image)}}" height="60">
                                        @endif

                                    </td>
                                    <td>{{ $list->display_banner }}</td>
                                    <td>{{$list->startdate}}</td>
                                    <td>{{$list->enddate}}</td>
                                    <td>{{$list->start_time}}</td>
                                    <td>{{$list->end_time}}</td>
                                    <td>{{$list->coupon_code}}</td>
                                    <td>{{$list->free_shipping}}</td>

                                    <td>
                                        <div class="switch">
                                            <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input" {{ $list->status=='disable' ? '' : 'checked' }} >
                                            <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-primary"  href="{{action('Backend\OfferController@edit', [$list->id])}}"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a class="btn btn-xs btn-danger del{{$list->id}}" href="javascript:void(0);" onclick="deleteOffer('{!! $list->id !!}')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="12" class="text-center">No data in record yet</td>
                                </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@endsection

@section('js')

<script src="{{ asset('admin/pages/offer.js') }}"></script>

@endsection