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
                                    <tr>
                                        <td class="mv-icon">
                                            <i class="fa fa-file-code-o fa-2x"></i>
                                        </td>
                                        <td class="text-left">route</td>
                                        <td class="text-left">Ismételten felolvassa a routes mappa tartalmát, és frissíti a routing-ot, egy route::clear, és egy route::cache történik. </td>
                                        <td class="text-center">
                                        <button class="btn btn-success" 
                                                data-toggle="modal" 
                                                data-target="#commandModal"
                                                onclick="runCommandConfirm('runalma', 'Nem szabad almát dobni', 'alma')">
                                                <i class="fa fa-play fa-2x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mv-icon">
                                            <i class="fa fa-file-code-o fa-2x "></i>
                                        </td>
                                        <td class="text-left">view</td>
                                        <td class="text-left">Frissíti a blade templatekből generált view-kat. Szintén clear és cache parancsok kerülnek futtatásra. </td>
                                        <td class="text-center">
                                        <button class="btn btn-success" 
                                                data-toggle="modal" 
                                                data-target="#commandModal"
                                                onclick="runCommandConfirm('alma', 'Nem szabad almát dobni', 'runalma')">
                                                <i class="fa fa-play fa-2x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mv-icon">
                                            <i class="fa fa-cog fa-2x "></i>
                                        </td>
                                        <td class="text-left">config</td>
                                        <td class="text-left">Frissíti a config leírókat. Akkor szükséges, ha valamilyen változás történik a hozzáférésekben, elérési utakban. </td>
                                        <td class="text-center">
                                        <button class="btn btn-success" 
                                                data-toggle="modal" 
                                                data-target="#commandModal"
                                                onclick="runCommandConfirm('alma', 'Nem szabad almát dobni', 'runalma')">
                                                <i class="fa fa-play fa-2x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mv-icon">
                                            <i class="fa fa-database fa-2x"></i>
                                        </td>
                                        <td class="text-left">migrate</td>
                                        <td class="text-left">Futtatja azokat a migárciókat, amelyek még nem voltak futtatva. Mindezt a migrate táblában tárolja el. Ha frissül az adatbázis séma, akkor szükséges.</td>
                                        <td class="text-center">
                                        <button class="btn btn-success" 
                                                data-toggle="modal" 
                                                data-target="#commandModal"
                                                onclick="runCommandConfirm('alma', 'Nem szabad almát dobni', 'runalma')">
                                                <i class="fa fa-play fa-2x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mv-icon">
                                            <i class="fa fa-database fa-2x"></i>
                                        </td>
                                        <td class="text-left">reload DB</td>
                                        <td class="text-left">Eldobja a jelenlegi adatbázist, és újra visszatölti a szerkezetét. Fontos, hogy csak a szerkezetét tölti vissza. Minden adat elvész ennek a futtatásakor. </td>
                                        <td class="text-center">
                                        <button class="btn btn-success" 
                                                data-toggle="modal" 
                                                data-target="#commandModal"
                                                onclick="runCommandConfirm('alma', 'Nem szabad almát dobni', 'runalma')">
                                                <i class="fa fa-play fa-2x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mv-icon">
                                            <i class="fa fa-database fa-2x"></i>
                                        </td>
                                        <td class="text-left">seed DB</td>
                                        <td class="text-left">Feltölti az adatbázist azzal a tartalommal, ami a seederekben van beírva. Ha az adatbázis eldobása nélkül futtatjuk, akkor hibára fut, a unique mezők miatt. (Pl user esetén az email). </td>
                                        <td class="text-center">
                                            <button class="btn btn-success" 
                                                data-toggle="modal" 
                                                data-target="#commandModal"
                                                onclick="runCommandConfirm('alma', 'Nem szabad almát dobni', 'runalma')">
                                                <i class="fa fa-play fa-2x"></i>
                                            </button>
                                        </td>
                                    </tr>
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
