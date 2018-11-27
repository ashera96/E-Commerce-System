function addnewstock(){
    var crop = document.getElementById("plist").value;
    var type = document.getElementById("type").value;
    var qty = document.getElementById("qty").value;
    var pdate = document.getElementById("pdate").value;
    var edate = document.getElementById("edate").value;
    var price = document.getElementById("price").value;
    if (plist == "" || type == "" || qty == "" || price == "" || edate=="")
        alert("Please all the data in input box!");
    else {
    
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
                  
                   var cell1 = row.insertCell(0);
                   var cell2 = row.insertCell(1);
                   var cell3 = row.insertCell(2);
                   var cell4 = row.insertCell(3);
                   var cell5 = row.insertCell(4);
                   var cell6 = row.insertCell(5);
                   var cell7= row.insertCell(6);
                    var s = '<button class="btn btn-danger btn-sm" onclick="delete_product(this);"><i class="fa fa-trash-o"></i></button>'
                    
                    cell1.innerHTML = "<input type='text'  onkeyup='changeDetect(this,1)' id='pName' value='" + crop + "' style='width:100%';>";
                    cell2.innerHTML = "<input type='text'  onkeyup='changeDetect(this,2)' id='type' value='" + type + "' style='width:70%'>";
                    cell3.innerHTML = "<input type='text'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='qauntityInput' value='" + qty+ "' style='width:90%'>";
                    cell4.innerHTML = "<input type='text'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='perprice' value='" + perprice + "' style='width:90%'>";
                    cell5.innerHTML = "<input type='date'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='pdate' value='" + pdate + "' style='width:90%'>";
                    cell6.innerHTML = "<input type='date'  onkeyup='changeDetect(this,3)' onclick='changeDetect(this,3)' id='edate' value='" + edate + "' style='width:90%'>";
                    cell7.innerHTML = s;
                    document.getElementById('boxID').value=(parseInt(document.getElementById('boxID').value)+1);
       console.log("Document written with ID: ", docRef.id);
    })
    .catch(function(error) {
        console.error("Error adding document: ", error);
    });
}
}

function updatestock(){
    
        var myTab = document.getElementById('hist_table');

        // LOOP THROUGH EACH ROW OF THE TABLE AFTER HEADER.
        for (i = 1; i < myTab.rows.length; i++) {

            // GET THE CELLS COLLECTION OF THE CURRENT ROW.
            var objCells = myTab.rows.item(i).cells;

            // LOOP THROUGH EACH CELL OF THE CURENT ROW TO READ CELL VALUES.
            
                //console.log(objCells.item(1).children[0].value);
                db.collection("stock").doc(id).update({
                    crop: objCells.item(0).children[0].value,
                    type:objCells.item(1).children[0].value,
                    quantity:objCells.item(2).children[0].value,
                    perprice:objCells.item(3).children[0].value,
                    produceddate:objCells.item(4).children[0].value,
                    expiredate:objCells.item(5).children[0].value     
                })
                .then(function() {
                    console.log("Document successfully updated!");
                });
            
            
        }



    

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
                    var s = '<button class="btn btn-danger btn-sm" id="'+doc.id  +'" onclick="deletestock(this.id);"><i class="fa fa-trash-o"></i></button>'
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

function deletestock(id){
    if(confirm("Do you want to delete this item?")){
        db.collection("stock").doc(id).delete().then(function() {
            getstocks();
            alert("Successfully deleted!");
        }).catch(function(error) {
            console.error("Error removing document: ", error);
        });
    }
}

function searchstock(){
    var id= document.getElementById('pid').value
    db.collection("stock").where("crop", "==", id)
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

