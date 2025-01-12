const form = document.querySelector('#form');
const isbnInput = document.querySelector('#b_isbn');
const titleInput = document.querySelector('#b_title');
const authorInput = document.querySelector('#b_author');
const priceInput = document.querySelector('#b_price');
const copiesInput = document.querySelector('#b_copies');
const pdfInput = document.querySelector('#b_copies');
const coverInput = document.querySelector('#b_copies');


form.addEventListener('submit', (event)=>{
    
    validateForm();
    console.log(isFormValid());
    if(isFormValid()==true){
        form.submit();
     }else {
		 event.preventDefault();
     }

});

function isFormValid(){
    const inputContainers = form.querySelectorAll('.icon');
    let result = true;
    inputContainers.forEach((container)=>{
        if(container.classList.contains('error')){
            result = false;
			return false;
        }
    });
    return result;
}

function validateForm() {
	
    //ISBN
    if(isbnInput.value.trim()==''){
        setError(isbnInput, 'ISBN can not be empty');
		return false;
    }else {
        setSuccess(isbnInput);
    }
	//TITLE
    if(titleInput.value.trim()==''){
        setError(titleInput, 'Title can not be empty');
		return false;
    }else {
        setSuccess(titleInput);
    }
	//AUTHOR
    if(authorInput.value.trim()==''){
        setError(authorInput, 'Author can not be empty');
		return false;
    }else {
        setSuccess(authorInput);
    }
	//COPIES
    if(copiesInput.value.trim()==''){
        setError(copiesInput, 'Copies can not be empty');
		return false;
    }else {
        setSuccess(copiesInput);
    }
    
	//PDF
    if(pdfInput.value.trim()==''){
        setError(pdfInput, 'must be selected');
		return false;
    }else {
        setSuccess(pdfInput);
    }
	//COVER
    if(coverInput.value.trim()==''){
        setError(coverInput, 'must be selected');
		return false;
    }else {
        setSuccess(coverInput);
    }
	
}

function setError(element, errorMessage) {
    const parent = element.parentElement;
    if(parent.classList.contains('success')){
        parent.classList.remove('success');
    }
    parent.classList.add('error');
    const paragraph = parent.querySelector('p');
    paragraph.textContent = errorMessage;
}

function setSuccess(element){
    const parent = element.parentElement;
    if(parent.classList.contains('error')){
        parent.classList.remove('error');
    }
    parent.classList.add('success');
}





