@extends('dashboard::layouts.dashboard')


@section('title',$name)
@section('description',$description)



@section('navbar')
    <div class="text-right">
        <div class="btn-group" role="group">
            <a href="{{ route('dashboard.uslugi.services.create')}}" class="btn btn-link"><i
                        class="icon-plus fa fa-2x"></i></a>
        </div>
    </div>
@stop

@section('content')


    <!-- main content  -->
    <section class="wrapper-md">
        <div class="bg-white-only bg-auto no-border-xs">

            @if($services->count() > 0)
                <div class="card">

                    <div class="card-body row">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="w-xs">{{trans('dashboard::common.Manage')}}</th>
                                    <th>{{trans('dashboard::systems/users.name')}}</th>
                                    <th>{{trans('dashboard::systems/users.email')}}</th>
                                    <th>{{trans('dashboard::common.Last edit')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td class="text-center">
                                            <a href="{{ route('dashboard.uslugi.services.edit',$service->id) }}"><i
                                                        class="fa fa-bars"></i></a>
                                        </td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->measure }}</td>

                                        <td>{{ $service->updated_at or $service->created_at }}</td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <footer class="card-footer">
                        <div class="row">
                            <div class="col-sm-8">
                                <small class="text-muted inline m-t-sm m-b-sm">{{trans('dashboard::common.show')}} {{$services->total()}}
                                    -{{$services->perPage()}} {{trans('dashboard::common.of')}} {!! $services->count() !!} {{trans('dashboard::common.elements')}}</small>
                            </div>
                            <div class="col-sm-4 text-right text-center-xs">
                                {!! $services->links('dashboard::partials.pagination') !!}
                            </div>
                        </div>
                    </footer>
                </div>

            @else

                <div class="jumbotron text-center bg-white not-found">
                    <div>
                        <h3 class="font-thin">{{trans('dashboard::systems/users.not_found')}}</h3>

                        <a href="{{ route('dashboard.uslugi.services.create')}}" class="btn btn-link">
                            {{trans('dashboard::systems/users.create')}}
                        </a>
                    </div>
                </div>

            @endif

        </div>
    </section>
    <!-- / main content  -->


@stop

