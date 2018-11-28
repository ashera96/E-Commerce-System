function addorder(order,user){
    db.collection("Orders").doc().set({
        userid:user,
        items:order
    },{ merge: true })
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
                    row.insertCell(6).innerHTML='<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addPayment" name="buy" id="'+doc.id+'" onclick="addtocart(this.id);" type="button">Add to cart</button>'

                    

            // doc.data() is never undefined for query doc snapshots
            //console.log(doc.id, " => ", doc.data());
        });
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });
    
}


function getmyorders(userid) {
    //var id= document.getElementById('pid').value
    db.collection("orders").where("uid", "==", userid)
    .get()
    .then(function(querySnapshot) {
        querySnapshot.forEach(function(doc) {
           // output.push(doc.data());
            var table = document.getElementById("productsDetails");
                
                    for(var i = table.rows.length - 1; i > 0; i--)
                    {
                        table.deleteRow(i);
                    }
                   // out=searchstock("10");
                    var row = table.insertRow(table.rows.length), i;
                   // console.log(out);
                   for (i in doc.order) {
                   
                    row.insertCell(0).innerHTML = doc.data().order[i].crop;
                   row.insertCell(1).innerHTML = doc.data().order[i].type;
                   row.insertCell(2).innerHTML = doc.data().order[i].quantity;
                   row.insertCell(3).innerHTML = doc.data().order[i].price;
                    
                }
                   
                   

            // doc.data() is never undefined for query doc snapshots
            console.log(doc.id, " => ", doc.data());
            
        });
    })
    .catch(function(error) {
        alert('stock id not found');
        console.log("Error getting documents: ", error);
    });
}


function addtocart(id) {
    var docRef = db.collection("stock").doc(id);
    docRef.get().then(function(doc) {
    if (doc.exists) {      
        console.log("Document data:", doc.data());
        document.getElementById('crop_id').value = doc.data().crop;
        document.getElementById('type_id').value = doc.data().type;
        document.getElementById('price_id').value = doc.data().perprice;

    } else {
            // doc.data() will be undefined in this case
            console.log("No such document!");
    }
    }).catch(function(error) {
        console.log("Error getting document:", error);
    });



}

