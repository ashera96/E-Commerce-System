function addnewstock(){
    if (plist == "" || type == "" || qty == "" || price == "" || edate=="")
        alert("Please all the data in input box!");
        else {
    var crop = document.getElementById("plist").value;
    var type = document.getElementById("type").value;
    var qty = document.getElementById("qty").value;
    var pdate = document.getElementById("pdate").value;
    var edate = document.getElementById("edate").value;
    var price = document.getElementById("price").value;
    db.collection("stock").add({
        crop: crop,
        type:type,
        quantity:qty,
        perprice:price,
        produceddate:pdate,
        expiredate:edate

    })
    .then(function(docRef) {
        var row = table.insertRow(-1);
       console.log("Document written with ID: ", docRef.id);
    })
    .catch(function(error) {
        console.error("Error adding document: ", error);
    });
}
}

function updatestock(stock){
    db.collection("students").doc(regno).update({
       
    })
    .then(function() {
        console.log("Document successfully updated!");
    }); 

}

function deletestock(stock){

}

function purchasestockupdate(stock){

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
                    row.insertCell(0).innerHTML = doc.data().productid;
                    row.insertCell(1).innerHTML = doc.data().productid;
                    row.insertCell(2).innerHTML = doc.data().productid;
                    row.insertCell(3).innerHTML = doc.data().productid;
                    row.insertCell(4).innerHTML = doc.data().productid;
                    row.insertCell(5).innerHTML = doc.data().productid;
                    row.insertCell(6).innerHTML = doc.data().productid;
                    row.insertCell(7).innerHTML = doc.data().productid;

            // doc.data() is never undefined for query doc snapshots
            //console.log(doc.id, " => ", doc.data());
        });
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });
    
}

function searchstock(){
    var id= document.getElementById('pid').value
    db.collection("stock").where("productid", "==", id)
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
                    row.insertCell(0).innerHTML = doc.data().productid;
                    row.insertCell(1).innerHTML = doc.data().productid;
                    row.insertCell(2).innerHTML = doc.data().productid;
                    row.insertCell(3).innerHTML = doc.data().productid;
                    row.insertCell(4).innerHTML = doc.data().productid;
                    row.insertCell(5).innerHTML = doc.data().productid;
                    row.insertCell(6).innerHTML = doc.data().productid;
                    row.insertCell(7).innerHTML = doc.data().productid;

            // doc.data() is never undefined for query doc snapshots
            console.log(doc.id, " => ", doc.data());
            
        });
    })
    .catch(function(error) {
        alert('stock id not found');
        console.log("Error getting documents: ", error);
    });
    
}

function getstocks(){
    var table = document.getElementById("hist_table");
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
                    row.insertCell(0).innerHTML = doc.data().productid;
                    row.insertCell(1).innerHTML = doc.data().productid;
                    row.insertCell(2).innerHTML = doc.data().productid;
                    row.insertCell(3).innerHTML = doc.data().productid;
                    row.insertCell(4).innerHTML = doc.data().productid;
                    row.insertCell(5).innerHTML = doc.data().productid;
                    row.insertCell(6).innerHTML = doc.data().productid;
                    row.insertCell(7).innerHTML = doc.data().productid;

            // doc.data() is never undefined for query doc snapshots
            //console.log(doc.id, " => ", doc.data());
        });
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });
    
}
