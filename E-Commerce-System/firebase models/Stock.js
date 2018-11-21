function addnewstock(crop){
    db.collection("students").doc().set(crop)
    .then(function(docRef) {
       console.log("Document written with ID: ", docRef.id);
    })
    .catch(function(error) {
        console.error("Error adding document: ", error);
    });
}

function updatestock(stock){

}

function deletestock(stock){

}

function purchasestockupdate(stock){

}

function getallstocks(){

}

function searchstock(name){

}