@extends('admin._layout.login_layout')

@section('content')

    <div class="col-md-9">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                Weblap áttekintés
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4 mb-3 text-center">
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-body py-4">
                                <h1 class="card-title">
                                    <svg class="card__icon--dark"><use xlink:href="apa/img/icons.svg#icon-users"></use></svg>
                                    <small>2</small>
                                </h1>
                                <h4 class="card-subtitle">Felhasználók</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-body py-4">
                                <h1 class="card-title">
                                    <svg class="card__icon--dark"><use xlink:href="apa/img/icons.svg#icon-award"></use></svg>
                                    <small>4</small>
                                </h1>
                                <h4 class="card-subtitle">Játékok</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-body py-4">
                                <h1 class="card-title">
                                    <svg class="card__icon--dark"><use xlink:href="apa/img/icons.svg#icon-gift"></use></svg>
                                    <small>4</small>
                                </h1>
                                <h4 class="card-subtitle">Jams</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-body py-4">
                                <h1 class="card-title">
                                    <svg class="card__icon--dark"><use xlink:href="apa/img/icons.svg#icon-bar-chart"></use></svg>
                                    <small>123</small>
                                </h1>
                                <h4 class="card-subtitle">Látogatók</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                Legutóbbi játékok
            </div>
            <div class="card-body">
                <div class="row  mb-3 text-center">
                    <div class="col">
                        <div class="card mb-2 rounded-3 shadow-sm">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ikon</th>
                                    <th scope="col">Név</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Kiadási dátum</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><img src="apa/img/OneTruePairicon.png" alt="" class="img-fluid jam-icon"></td>
                                    <td>One True Pair</td>
                                    <td>Jam 1</td>
                                    <td>2022.01.03.</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td><img src="apa/img/DarkLiquidCompanyicon.png" alt="" class="img-fluid jam-icon"></td>
                                    <td>Dark Liquid Company</td>
                                    <td>Jam 2</td>
                                    <td>2022.01.03.</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td><img src="apa/img/EscapeFromTheBankicon.png" alt="" class="img-fluid jam-icon"></td>
                                    <td>Escape From The Bank</td>
                                    <td>Jam 3</td>
                                    <td>2022.01.03.</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td><img src="apa/img/PotholePanicicon.png" alt="" class="img-fluid jam-icon"></td>
                                    <td>Pothole Panic</td>
                                    <td>JAM 4</td>
                                    <td>2022.01.03.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                Legutóbbi JAM-ek
            </div>
            <div class="card-body">
                <div class="row  mb-2 text-center">
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ikon</th>
                                    <th scope="col">Név</th>
                                    <th scope="col">Téma</th>
                                    <th scope="col">Versenyzők</th>
                                    <th scope="col">Kezdési dátum</th>
                                    <th scope="col">Hossz</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><img src="apa/img/brackeys-2.png" alt="" class="img-fluid"></td>
                                    <td>Brackey's Game Jam #2</td>
                                    <td>Love is blind</td>
                                    <td>318</td>
                                    <td>2019-02-16</td>
                                    <td>7</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td><img src="apa/img/pizza-jam.png" alt="" class="img-fluid"> </td>
                                    <td>Pizza Jam</td>
                                    <td>I am the strongest</td>
                                    <td>53</td>
                                    <td>2019-03-22</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td><img src="apa/img/ludum-dare-44.png" alt="" class="img-fluid jam-icon"></td>
                                    <td>Ludum Dare 44</td>
                                    <td>Your life is currency</td>
                                    <td>2538</td>
                                    <td>2019-04-27</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td><img src="apa/img/brackeys-3.png" alt="" class="img-fluid"></td>
                                    <td>Brackey's Game Jam 2020.1</td>
                                    <td>Holes</td>
                                    <td>700</td>
                                    <td>2020-02-16</td>
                                    <td>7</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
