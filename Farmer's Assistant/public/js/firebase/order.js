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

function addtocart(){
    var buttons = document.getElementsByTagName("button");
    var buttonsCount = buttons.length;
    for (var i = 0; i <= buttonsCount; i += 1) {
        buttons[i].onclick = function(e) {
            alert(this.id);
        };
    }

}

