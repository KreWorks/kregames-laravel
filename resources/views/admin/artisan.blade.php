@extends('admin._layout.login_layout')

@section('content')

    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0" >Futtatható artisan command-ok</h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table  ">
                                    <tr class="heading-td">
                                        <td class="text-left">Command</td>
                                        <td class="text-left">Magyarázat</td>
                                        <td class="text-center">Futtatás</td>
                                    </tr>
                                    @foreach($commands as $command)
                                    <tr>
                                        <td class="mv-icon">
                                            <i class="fa {{ $command['fa-icon'] }} fa-2x"></i>
                                        </td>
                                        <td class="text-left">{{ $command['route'] }}</td>
                                        <td class="text-left">{{ $command['description'] }}</td>
                                        <td class="text-center">
                                        <button class="btn btn-success" 
                                                data-toggle="modal" 
                                                data-target="#commandModal"
                                                onclick="runCommandConfirm('{{$command['route']}}', '{{$command['command']}}', '{{$command['warningMsg']}}')">
                                                <i class="fa fa-play fa-2x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 " >
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-sm-flex ">
                            <h4 class="header-title mb-0" >Eredmény</h4>
                        </div>
                        <div class="market-status-table mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- market value area end -->
    </div>
    
@include('admin._layout.command_modal')

@endsection
