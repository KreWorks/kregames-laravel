<?php
$currentPage = 1;
?>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        @foreach($tableLabels as $column)
            <th scope="col">{{ ucfirst($column) }}</th>
        @endforeach
        <th scope="col">Műveletek</th>
    </tr>
    </thead>
    <tbody>
    @foreach($datas as $index => $data)
    <?php
    $groupIndex = floor($index / 10) + 1;
    ?>
        <tr class=" table-row table-row-{{$groupIndex}}" style="display: {{$groupIndex == $currentPage ? 'table-row' : 'none'}}">
            @include('admin.'.$route.'.entity')
        </tr>
    @endforeach
    </tbody>
</table>
<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item disabled" id="previousButton" onClick="paginate('previous')">
            <a class="page-link">Előző</a>
        </li>
        @for($i = 1; $i <= ceil(count($datas) / 10); $i++)
        <?php 
        $isActive = $currentPage == $i ? 'active': '';
        ?>
        <li class="page-item {{$isActive}}" onClick="paginate({{$i}})" data-index="{{$i}}"><a class="page-link" >{{$i}}</a></li>
        @endfor
        <li class="page-item" id="nextButton" onClick="paginate('next')">
            <a class="page-link">Következő</a>
        </li>
    </ul>
</nav>
<script>
var currentPage = {{$currentPage}};
var itemCount = {{count($datas)}};
paginate(1); 
function paginate(index) {
    setDisplayForAGroup('.table-row-' + currentPage, 'none');
    if (index == 'previous') currentPage--;
    else if (index == 'next') currentPage++;
    else currentPage = index;

    setDisplayForAGroup('.table-row-' + currentPage, 'table-row');

    var nextButton = document.getElementById('nextButton');
    var previousButton = document.getElementById('previousButton');
    var buttons = document.querySelectorAll('.page-item');

    buttons.forEach((button) => {
        button.classList.remove('active'); 
        if (button.getAttribute('data-index') == currentPage) {
            button.classList.add('active');
        }
    });

    previousButton.classList.remove('disabled');
    nextButton.classList.remove('disabled');
    if (currentPage == 1) {
        nextButton.classList.add('disabled');
    }
    if (currentPage == Math.ceil(itemCount / 10)) {
        previousButton.classList.add('disabled');
    }
}

function setDisplayForAGroup(groupName, displayText) {
    var rows = document.querySelectorAll(groupName);
    rows.forEach((row) => {
        row.style.display = displayText;
    });
}
</script>