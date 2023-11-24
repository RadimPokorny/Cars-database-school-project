function makeCarmodelsList(event){
    var makeelm = event.target;
    var value = makeelm.value;
    
    let elm = document.getElementById("modellist");

    while (elm.options.length > 0){
        elm.remove(0);
    }

    let arr=window.eval(carmakes[value-1]);

    for(let key in arr){
        let option = document.createElement("option");
        option.setAttribute('value', key);

        let optionText = document.createTextNode(arr[key]);
        option.appendChild(optionText);

        elm.appendChild(option);
    }


}