$(document).ready(function(){
    var model = document.getElementById("model-name");
    var color = document.getElementById("color");
    var size = document.getElementById("size");
    var heelHeight = document.getElementById("heel-height");
    var categ = document.getElementById("categ");
    var price = document.getElementById("price");
    var quantity = document.getElementById("quantity");

    $('#prodID').change(function(){
        //Selected value
        var inputValue = $(this).val();
        //alert("value in js "+inputValue);

        //Ajax for calling php function
        $.post('./php/actions/submit.php', { dropdownValue: inputValue }, function(data){
            var parsedObj = JSON.parse(data);
            model.value = parsedObj.Model;
            color.value = parsedObj.Color;
            size.value = parsedObj.Size;
            heelHeight.value = parsedObj.HeelHeight;
            categ.value = parsedObj.Category;
            price.value = parsedObj.Price;
            //quantity.value = parsedObj.Stock;

            //alert('Response:  '+ parsedObj.ProductID);

            //$('#model-name').val(data["Model"]);
            //do after submission operation in DOM
        });
    });
});