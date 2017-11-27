@extends('dashboard::layouts.dashboard')


@section('title',trans('salador/uslugi::uslugi.Uslugi'))
@section('description',trans('salador/uslugi::uslugi.description'))


@section('content')


    <!-- main content  -->
    <section class="wrapper-xl bg-white col-md-7 col-xs-12">


        <div class="row">
            <!-- Hardware  -->
            <div class="col-lg-6">
                <h4><i class="fa m-r-sm fa-server"></i> {{trans('salador/uslugi::uslugi.Hardware.Title')}}
                </h4>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td><p>{{trans('salador/uslugi::uslugi.Hardware.Uptime')}}: </p></td>
                            <td><p class="text-right">{{ $hardware }}</p></td>
                        </tr>
                        <tr>
                            <td><p>{{trans('salador/uslugi::uslugi.Hardware.Board Temperature')}}: </p>
                            </td>
                            <td><p class="text-right">{{ $hardware }}</p></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>	
    </section>

@endsection