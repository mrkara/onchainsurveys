    const lastElements = document.querySelector("#lastElements");
    //const addOptionBtn = document.querySelector("#addOptionBtn");

    const del = document.querySelector(".btn-danger");
    const surveyForm = document.querySelector("#surveyForm");
 
    const info = document.querySelector("#info");
 


    function addOption(e,counter = false){

        const lastOption =  document.querySelector("#lastOption");

        let question = e.target.closest(".question");

        const option = document.createElement("div");
        option.className ='form-group';
        option.innerHTML = `<div class="input-group">
      		<span class="input-group-text"></span>
            <input type="text" class="form-control" name="${counter}[options][]" placeholder="Option text" maxlength="255">
            <button class="btn btn-danger btn-xs" onClick="delOption(event)"><i class="fas fa-times-circle"></i></button>
          </div>`; 
 
        let btnElement = e.target.closest(".form-group");

        btnElement.insertAdjacentElement('beforebegin',option);

       sortLetters(question);
    }


    function delOption(e){

         let delBtnDiv = e.target.closest(".form-group");  
         let question = e.target.closest(".question");
         delBtnDiv.remove();
         sortLetters(question);
    }

    
    /*
		harfleri sıralar ve her işlemden sonra şıkları yeniden isimlendirir
    */
    function sortLetters(question){
    	const letters = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        console.log(question);
    	let lettersLabel = question.querySelectorAll('.input-group-text');
    	console.log(lettersLabel); 
    	lettersLabel.forEach(function(item,key){
     		item.textContent=letters[key];
    	})

    	// if(lettersLabel.length > 7)
    	// {
    	// 	//addOptionBtn.style.visibility = 'hidden';  
     //        addOptionBtn.style.display = 'none';
     //        //addOptionBtn.remove();    
    	// }else{
    	// 	//addOptionBtn.style.visibility = 'visible'; 
     //        addOptionBtn.style.display = 'block'; 
    	// }

    }


    function formSave(e){
    	 
        let error;
        let form = document.getElementById("createSurvey");
        let formAction = form.action;
        let formData = new FormData(form);


        // loading image
        let load_image = document.querySelector("#load_image");
        load_image.style.display="block";


        /* tüm .form-control classına sahip olan elementleri al */ 
        let elements = document.querySelectorAll(".form-control")
        //console.log(elements);

        elements.forEach(function(item,key){
            /* hata durumunda eklenmiş form-error classı varsa sil */ 
            item.parentNode.classList.remove('form-error');
            /* boş alan kontrolü yap artı trim() ile boşluk karakteri (backspace) girilmiş ise temizle */ 
            if(item.value.trim() == ''){
                /* hata varsa form-error classını ekle */
                item.parentNode.classList.add('form-error');
                /* hata varsa error değişkenini true yap */ 
                error = true;
            }
        });


        // result div clear
        document.getElementById("result").innerHTML='';
 

      if(error){
           document.getElementById("result").innerHTML = '<div class="text-primary"> <strong>Error!</strong> Please fill in all blank fields. <i class="fas fa-times"></i> </div>';
          load_image.style.display = "none";
      }else{


        var xmlhttp = ajaxReq();
        xmlhttp.open("POST", formAction, true);  
        //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(formData); 

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               try {
                    
                    load_image.style.display = "none";

                   let result = JSON.parse(xmlhttp.responseText);

                   let form_errors = document.querySelectorAll('.form_error');

                    for(let i = 0; i < form_errors.length; i++){
                        form_errors[i].innerHTML="";
                    }

                      
                    if(result.error){
                        if(result.date_error){
                            error_show(result.date_error,'start_date_error');
                            error_show(result.date_error,'end_date_error');
                        }
 
                        document.getElementById("result").innerHTML = result.message;
 
                    }else{
                        document.getElementById("result").innerHTML = result.message;
                        setTimeout(function(){ 
                            window.location.href = "survey/my_surveys";
                        }, 3000);
                     }


               } catch (error) {
                  // throw Error;
                 // document.getElementById("result").innerHTML = error;
                 console.log(error);
               }


            }

            
        }

         
      }

 
      e.preventDefault();

     }
 

    function messageInfo(type,message){
    	const alert=`
    		<div class="alert alert-${type} alert-dismissible">
			    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			    ${message}
			</div>
    	`;
    	document.getElementById("alert").innerHTML=alert;
    }


    // anket soru ekleme, sevgi bu alanların açıklamalarını ingilize yazar mısın
    function addQuestionBlock(e){

        if( typeof addQuestionBlock.counter == 'undefined' ) {
            addQuestionBlock.counter = 0;
        }
        addQuestionBlock.counter++;
        
        const lastQuestion = document.getElementById("lastQuestion");
        const addQuestion = document.createElement("div");
        
         
        addQuestion.innerHTML = `<div class="question">
        <div class="float-end clear-question" onclick="clearQuestion(event);">
            <i class="fas fa-times-circle "></i>
        </div>

        "<label for="comment">Enter your question</label>
                <div class="form-group input-group">
                <textarea class="form-control" rows="2" id="text_${addQuestionBlock.counter}" name="${addQuestionBlock.counter}[text]" placeholder="Enter your question" maxlength="255"></textarea>
                </div>
        
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text">A</span>
                        <input type="text" class="form-control" name="${addQuestionBlock.counter}[options][]" placeholder="Option text" maxlength="255">
                        <button class="btn btn-danger btn-xs deleteOption" disabled><i class="fas fa-times-circle"></i></button>
                    </div>
                </div>
        
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text">B</span>
                        <input type="text" class="form-control" name="${addQuestionBlock.counter}[options][]" placeholder="Option text" maxlength="255">
                        <button class="btn btn-danger btn-xs deleteOption" disabled><i class="fas fa-times-circle"></i></button>
                    </div>
                </div>
        
                <div class="form-group">
                    <div class="float-end">
                        <button type="button" class="btn btn-outline-secondary btn-sm " id="" onclick="addOption(event,${addQuestionBlock.counter});"> <i class="fas fa-plus-circle"></i> Add Option</button>
                    </div>
                </div>
        </div>
        `;

        lastQuestion.appendChild(addQuestion);

        questionControl();

    }

     
   
      // soruyu siler
      function clearQuestion(e){
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#6c757d',
          cancelButtonColor: 'rgb(184, 43, 56)',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            let question = e.target.closest(".question");
            question.remove();
            console.log(question);
            questionControl();
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })

        

      }


      // soru sayısını kontrol eder, soru sayısı 1 den küçük ise finish survey butonunu gizler değilse görünür yapar
      function questionControl(){
        let questions = document.querySelectorAll('.question');
        const finishSurvey = document.querySelector("#finishSurvey");

        if(questions.length < 1){
            finishSurvey.style.display = 'none';
        }else{
            finishSurvey.style.display = 'inline-block';
        }
  
      }