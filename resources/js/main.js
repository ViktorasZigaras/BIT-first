"use strict";

/*----------------------- save content axios----------------------------*/

function  editText(editId) {
console.log(editId)
    const txt = document.getElementById("textArea").value;  

    if (txt != undefined || txt != null || txt.length >= 0 || txt != "" || txt != NaN) {
        let text = txt.split(/\s+/);       
        axios.post('http://localhost/wordpress/wp-content/plugins/BIT-first/api/?route=api-admin', {
            idea: text, 
            editId: editId,  
        }).catch(err => {
            console.log(err instanceof TypeError);
        });
        setTimeout(renderTreeColons, 300);
    }
}

function solutionText(sId) {

    const txt1 = document.getElementById("textArea1").value;

    if (    txt1 != undefined || txt1 != null || txt1.length >= 0 || txt1 != "" || txt1 != NaN) {
       let text1 = txt1.split(/\s+/);
        axios.post('http://localhost/wordpress/wp-content/plugins/BIT-first/api/?route=api-admin', {
           soliution: text1,
           solutionId: sId,
        }).catch(err => {
            console.log(err instanceof TypeError);
        });
        setTimeout(renderTreeColons, 300);
    }
}

/*----------------------- delete content axios----------------------------*/

function deleteIdea(deleteId){

    axios.post('http://localhost/wordpress/wp-content/plugins/BIT-first/api/?route=api-admin', {
        deletedId: deleteId,
     }).catch(err => {
         console.log(err instanceof TypeError);
     });
     setTimeout(renderTreeColons, 1000);
}

//  textArea.addEventListener("input", function(){

//    let maxlength = this.getAttribute("maxlength");
//    let currentLength = this.value.length;

//    if( currentLength >= maxlength ){
//      document.getElementById("count").innerHTML = "0  simboliu liko";
//    }else{
//      document.getElementById("count").innerHTML = maxlength - currentLength + " simboliu liko";
//      //console.log(maxlength - currentLength + " chars left");
//    }
//  });

//  /*------------------------------render data  axios-----------------------------------------*/

window.addEventListener('load', renderTreeColons);

function renderTreeColons() {

    axios.get('http://localhost/wordpress/wp-content/plugins/BIT-first/api/?route=api-admin', {

    })
        .then(function (response) {
            
            if (response.status == 200 && response.statusText == 'OK') {
                const data = response.data.allData;

                let keys = [];

                for (let key in data) {
                    keys.push(key);
                }

                const rende = document.getElementById('box');
                let HTMLString = '';

                for (let i = keys.length - 1; i >= 0; i--) {
                    let value = data[keys[i]];
                    HTMLString +=
                        `<div class="box"> 
            <div class="text"><div class="data" >${value.post_date}</div>                 
                </div>
                <div class="ideaContent">
                    <div class="ideaTextEdit">
                        <textarea class="ideaText" maxlength="200" name="idea" id="textArea" data-attribute_name="">
                                ${value.idea_content}
                        </textarea>  
                        <button  class="ideaBtn delIdea" id="${keys[i]}">
                            Trinti
                        </button> 
                        <button class="ideaBtn edit editButtonIdea" id="${keys[i]}">
                            Saugoti
                        </button>
                    </div>
                    <div class="ideaSoliution">
                        <textarea class="ideaTextSoliution" maxlength="200" name="idea" id="textArea1" > 
                            ${value.idea_solution}                     
                        </textarea>
                        <button class="ideaBtn delIdea answer" id="${keys[i]}">
                            Trinti
                        </button> 
                        <button  class="ideaBtn addButtonIdea" id="${keys[i]}">
                            Sprendimas
                        </button> 
                    </div> 
                    <span class="textCount" id="count"></span>
                    </div>  
                        <div class="like" data-custom-id="${keys[i]}">
                            <span class="like__number">Like: ${value.idea_like}</span>             
                        </div>            
                    </div>
                </div>`;
                }
                rende.innerHTML = HTMLString;

                const editBtn = document.querySelectorAll(".editButtonIdea");
                const postBtn = document.querySelectorAll(".addButtonIdea");
                const deletetBtn = document.querySelectorAll(".delIdea");

                for (let i = 0; i < postBtn.length; i++) {
                    let sId = postBtn[i].id;
                    postBtn[i].addEventListener('click', function () { solutionText(sId); } , false);                   
                }
                for (let i = 0; i < editBtn.length; i++) {
                    let editId = editBtn[i].id;
                    editBtn[i].addEventListener('click', function () { editText(editId); } , false);                     
                }
                for (let i = 0; i < deletetBtn.length; i++) {
                    let deleteId =  deletetBtn[i].id;
                    deletetBtn[i].addEventListener('click', function () { deleteIdea(deleteId); }, false);
                }               
            }
            // console.log(response.status);
            // console.log(response.statusText);
            //  console.log(response.headers);
            // console.log(response.config);
            return response;

        }).catch(function (error) {
            console.log(error instanceof TypeError);
        });
}