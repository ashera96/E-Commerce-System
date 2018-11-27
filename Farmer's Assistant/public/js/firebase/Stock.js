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
        var table = document.getElementById("hist_table");
        var row = table.insertRow(table.rows.length);
                   console.log(doc.getData());
                   var cell1 = row.insertCell(0);
                   var cell2 = row.insertCell(1);
                   var cell3 = row.insertCell(2);
                   var cell4 = row.insertCell(3);
                   var cell5 = row.insertCell(4);
                   var cell6 = row.insertCell(5);
                   var cell7= row.insertCell(6);
                    var s = '<button class="btn btn-danger btn-sm" onclick="delete_product(this);"><i class="fa fa-trash-o"></i></button>'
                    
                    cell1.innerHTML = "<input type='text'  onkeyup='changeDetect(this,1)' id='pName' value='" + doc.getData().productid + "' style='width:100%';>";
                    cell2.innerHTML = "<input type='text'  onkeyup='changeDetect(this,2)' id='type' value='" + doc.getData().type + "' style='width:70%'>";
                    cell3.innerHTML = "<input type='number'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='qauntityInput' value='" + doc.getData().qty + "' style='width:90%'>";
                    cell4.innerHTML = "<input type='number'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='perprice' value='" + doc.getData().perprice + "' style='width:90%'>";
                    cell5.innerHTML = "<input type='date'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='pdate' value='" + doc.getData().pdate + "' style='width:90%'>";
                    cell6.innerHTML = "<input type='date'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='edate' value='" + doc.getData().edate + "' style='width:90%'>";
                    cell7.innerHTML = s;
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
                    row.insertCell(0).innerHTML = doc.data().crop;
                    row.insertCell(1).innerHTML = doc.data().type;
                    row.insertCell(2).innerHTML = doc.data().quantity;
                    row.insertCell(3).innerHTML = doc.data().perprice;
                    row.insertCell(4).innerHTML = doc.data().produceddate;
                    row.insertCell(5).innerHTML = doc.data().expiredate;
                    row.insertCell(6).innerHTML = (parseInt(doc.data().quantity))*(parseInt(doc.data().perprice));
                    

            // doc.data() is never undefined for query doc snapshots
            //console.log(doc.id, " => ", doc.data());
        });
    })
    .catch(function(error) {
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
            var table = document.getElementById("hist_table");
                    var row = table.insertRow(table.rows.length);
                   
                   var cell1 = row.insertCell(0);
                   var cell2 = row.insertCell(1);
                   var cell3 = row.insertCell(2);
                   var cell4 = row.insertCell(3);
                   var cell5 = row.insertCell(4);
                   var cell6 = row.insertCell(5);
                   var cell7= row.insertCell(6);
                    var s = '<button class="btn btn-danger btn-sm" id="'+doc.id  +'" onclick="delete_product();"><i class="fa fa-trash-o"></i></button>'
                    cell1.innerHTML = "<input type='text'  onkeyup='changeDetect(this,1)' id='pName' value='" + doc.data().crop + "' style='width:100%';>";
                    cell2.innerHTML = "<input type='text'  onkeyup='changeDetect(this,2)' id='type' value='" + doc.data().type + "' style='width:100%'>";
                    cell3.innerHTML = "<input type='text'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='qauntityInput' value='" + doc.data().quantity + "' style='width:100%'>";
                    cell4.innerHTML = "<input type='text'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='perprice' value='" + doc.data().perprice + "' style='width:100%'>";
                    cell5.innerHTML = "<input type='date'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)'  id='pdate' value='" + doc.data().produceddate + "' style='width:100%'>";
                    cell6.innerHTML = "<input type='date'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='edate' value='" + doc.data().expiredate + "' style='width:100%'>";
                    cell7.innerHTML = s;
                

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
                   row.insertCell(0).innerHTML = doc.data().crop;
                   row.insertCell(1).innerHTML = doc.data().type;
                   row.insertCell(2).innerHTML = doc.data().quantity;
                   row.insertCell(3).innerHTML = doc.data().perprice;
                   row.insertCell(4).innerHTML = doc.data().produceddate;
                   row.insertCell(5).innerHTML = doc.data().expiredate;
                   row.insertCell(6).innerHTML = (parseInt(doc.data().quantity))*(parseInt(doc.data().perprice));

            // doc.data() is never undefined for query doc snapshots
            console.log(doc.id, " => ", doc.data());
            
        });
    })
    .catch(function(error) {
        alert('stock id not found');
        console.log("Error getting documents: ", error);
    });
    
}

