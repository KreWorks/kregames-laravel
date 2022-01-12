
//Used in game and jam title's slug generation
function createSlug(name)
{
    var slug = name.toLowerCase();
    return slug.replace(' ', '-');
}

//Open modal with data
function getJamData()
{

}
function getAjaxData(method, url) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        console.log("returned");
        document.getElementById("demo").innerHTML = this.responseText;
    }
    xhttp.open("GET", "ajax_info.txt", true);
    xhttp.send();
}
