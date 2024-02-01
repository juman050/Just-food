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
                            <h3 class="box-title">Manage Allergies</h3>
                            <button type="button" class="btn btn-sm btn-primary btn-modal pull-right" data-href="{{action('Backend\AllergyController@create')}}" data-container=".allergy_modal"><i class="fa fa-plus"></i> Add</button>
                        </div>
                        <div class="box-body no-padding TableData">


                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>

    <div class="modal fade allergy_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ asset('admin/pages/allergy.js') }}"></script>
    
@endsection