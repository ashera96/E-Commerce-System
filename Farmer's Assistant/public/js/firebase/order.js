function addorder(order){
    db.collection("Orders").doc().set(order)
    .then(function(docRef) {
       console.log("Document written with ID: ", docRef.id);
    })
    .catch(function(error) {
        console.error("Error adding document: ", error);
    });
}

function getallstocks(){
    var table = document.getElementById("productsDetails");
    for(var i = table.rows.length - 1; i > 0; i--)
    {
        table.deleteRow(i);
    }
    db.collection("stock")
    .get()
    .then(function(querySnapshot) {
        querySnapshot.forEach(function(doc) {
            doc.data();
            
                   // out=searchstock("10");
                    var row = table.insertRow(table.rows.length);
                   // console.log(out);
                    row.insertCell(0).innerHTML = doc.data().crop;
                    row.insertCell(1).innerHTML = doc.data().type;
                    row.insertCell(2).innerHTML = doc.data().quantity;
                    row.insertCell(3).innerHTML = doc.data().perprice;
                    row.insertCell(4).innerHTML = doc.data().produceddate;
                    row.insertCell(5).innerHTML = doc.data().expiredate;
                    row.insertCell(6).innerHTML='<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addPayment" name="buy" id="'+doc.id+'" onclick="addtocart();" type="button">Add to cart</button>'

                    

            // doc.data() is never undefined for query doc snapshots
            //console.log(doc.id, " => ", doc.data());
        });
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });
    
}

function getfromid(id) {
    var docRef = db.collection("stock").doc(id);
    var data;
    docRef.get().then(function(doc) {
        if (doc.exists) {
            //get the data by using doc.data().whatevertheattribute u want eg: doc.data().perprice 
            var data=doc.data();
            return data;
            //console.log("Document data:", doc.data());
        } else {
            // doc.data() will be undefined in this case
            console.log("No such document!");
        }
    }).catch(function(error) {
        console.log("Error getting document:", error);
    });
}

function addtocart(id) {
    var data=getfromid(id);
    var crop = data.crop;
    var type = data.type;
    var price =data.perprice;
    alert(crop);
    alert(type);
    alert(price);
    alert("H");
    var productName = document.getElementById('product').value;
    var size = document.getElementById('size').value;
    var quantity = document.getElementById('qty').value;
    var color = document.getElementById('color').value;

    var price = document.getElementById('price').value;

    if (alertBrand == -1)
        alert("Brand not selected");
    else if (product == "" || size == "" || quantity == "" || price == "")
        alert("Please all the data in input box!");
    else if (Style == -1)
        alert("Select Style");
    else {
        var product = {
            product: productName,
            size: size,
            color: color,
            quantity: quantity,
            price: price,
            style: Style,
            Brand: BrandID
        }
        //console.log(product);
        dataProduct.push(product);
        var sizeRow = dataProduct.length;


        var table = document.getElementById("hist_table");

        var row = table.insertRow(-1);

        var cell1 = row.insertCell(0);
        var cell6 = row.insertCell(1);
        var cell4 = row.insertCell(2);
        var cell2 = row.insertCell(3);
        var cell3 = row.insertCell(4);
        var s = '<button class="btn btn-danger btn-sm" onclick="delete_product(this);"><i class="fa fa-trash-o"></i></button>'

        var cell5 = row.insertCell(5);
        cell1.innerHTML = "<input type='text'  onkeyup='changeDetect(this,1)' id='pName" + sizeRow + "' value='" + productName + "' style='width:100%';>";
        cell6.innerHTML = "<input type='text'  onkeyup='changeDetect(this,2)' id='sizeInput" + sizeRow + "' value='" + size + "' style='width:70%'>";
        cell4.innerHTML = "<input type='number'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='qauntityInput" + sizeRow + "' value='" + quantity + "' style='width:70%'>";
        cell3.innerHTML = "<p id='total" + sizeRow + "'>" + Math.ceil(quantity * price) + "<p>";
        cell5.innerHTML = s;
        cell2.innerHTML = "<input type='number'  onkeyup='changeDetect(this,4)' onclick='changeDetect(this,3)' id='priceInput" + sizeRow + "' value='" + price + "' style='width:70%;'>";
        document.getElementById('product').value = "";
        document.getElementById('size').value = "";
        document.getElementById('qty').value = "";
        document.getElementById('price').value = "";
    }



}

