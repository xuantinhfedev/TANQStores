function SelecetSize(size){
    (document.getElementById(""+size).style.backgroundColor = 'red' ); 
    (document.getElementById(""+size).name = "Ma"+size );
    var textfield = document.createElement("input");
        textfield.type = "hidden";
        textfield.value = size;
        textfield.name = "SizeSelect"+size;
        textfield.className = "ab"+size;
        document.getElementById('form').appendChild(textfield);

    
}
function testremove(){
    var text = document.getElementsByClassName("ab24")[0];
    // console.log(text[0].value);
    document.getElementById('form').removeChild(text);
}

