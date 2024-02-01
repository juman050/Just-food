@extends('admin.layout.master')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{$data['pageName']}}</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
                <li class="active">{{$data['pageName']}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Manage Customer</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-striped text-center" id="Table">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th >Name</th>
                                        <th >Email</th>
                                        <th >Phone</th>
                                        <th >Postcode</th>
                                        <th >Address</th>
                                        <th >Status</th>
                                        <th >Joining date</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($lists) > 0)
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($lists as $list)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$list->name}}</td>
                                        <td>{{$list->email}}</td>
                                        <td>{{$list->phone}}</td>
                                        <td>{{$list->post_code}}</td>
                                        <td>{{$list->address}}</td>
                                        <td>
                                            <div class="switch">
                                                <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input" {{ $list->status=='disable' ? '' : 'checked' }} >
                                                <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{changeDateFormate($list->created_at)}}</td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="deleteCustomer('{!! $list->id !!}')" class="btn btn-xs btn-danger del{{$list->id}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="text-center">No data in record yet</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>

@endsection

@section('js')
    <script src="{{ asset('admin/pages/customer.js') }}"></script>
@endsection