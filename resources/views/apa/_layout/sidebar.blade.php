<!-- sidebar starts -->
<nav class="col-md-3 d-md-block sidebar">
    <div class="list-group">
        <a href="{{route('admin')}}" class="list-group-item list-group-item-action active" aria-current="true">
            <span>
                <svg class="card__icon--white"><use xlink:href="apa/img/icons.svg#icon-home"></use></svg>
            </span>
            Dashboard
        </a>
        <a href="{{route('admin.jams.index')}}" class="list-group-item list-group-item-action">
            <span>
                <svg class="card__icon--dark"><use xlink:href="apa/img/icons.svg#icon-gift"></use></svg>
            </span>
            Jams
            <span class="badge bg-secondary rounded-pill ms-2">4</span>
        </a>
        <a href="{{route('admin.games.index')}}" class="list-group-item list-group-item-action">
            <span>
                <svg class="card__icon--dark"><use xlink:href="apa/img/icons.svg#icon-award"></use></svg>
            </span>
            Játékok
            <span class="badge bg-secondary rounded-pill ms-2">4</span>
        </a>
        <a href="{{route('admin.users.index')}}" class="list-group-item list-group-item-action">
            <span>
                <svg class="card__icon--dark"><use xlink:href="apa/img/icons.svg#icon-users"></use></svg>
            </span>
            Felhasználók
            <span class="badge bg-secondary rounded-pill ms-2">2</span>
        </a>
    </div>
</nav>
<!-- sidebar ends -->
