var current = 0;

function idName(id){
    return document.getElementById(id);
}

function tagName(tg){
    return document.getElementsByTagName(tg);
}

function hideMsg(){
    window.setTimeout(function(){
        idName("msg").style.display = "none";

    }, 3000);
}

function showTab(n){
    var tab = idName("container").getElementsByTagName("div");
    tab[n].style.display = "block";
    if(n == 0){
        idName("prev").style.display = "none";
    }
    else{
        idName("prev").style.display = "inline";
    }
    if(n == 3){
        idName("next").innerHTML = "Submit";
    }
    else{
        idName("next").innerHTML = "Next";
    }
    changeProgress(current);
}

function nextPrev(n){
    var tab = idName("container").getElementsByTagName("div");

    tab[current].style.display = "none";
    current = current + n;
    if(current == 4){
        idName("regForm").submit();
    }
    var pro = tagName("li");
    for(var i = 0; i < 4; i++){
        pro[i].style.fontWeight = "100";
    }
    pro[current].style.fontWeight = "900";
    showTab(current);
}

/*function validateForm(){
    var tab, inp, i, valid = true;
    tab = idName("container").getElementsByTagName("div");
    inp = tab[current].getElementsByTagName("input");
    if(current == 0){
        if(inp[1].value != inp[2].value){
            inp[1].className += " invalid";
            inp[2].className += " invalid";
            valid = false;
        }
    }
    for(i = 0; i < 3; i++){
        if(inp[i].value == ""){
            inp[i].className += " invalid";
            valid = false;
        }
    }
    return valid;
}*/

function changeProgress(n){
    var pro = tagName("li");
    pro[n].className += " active";
}
