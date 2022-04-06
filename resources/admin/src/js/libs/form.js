function validateText(parameter){
  let pattern = new RegExp( parameter.pattern );
  let value   = parameter.value.trim()

  if(pattern.test(value)){
    return true;
  }else{
    return false
  }
}

function validateSelect(parameter){
  if(parameter.value != '' && parameter.isValid == false){
    parameter.isValid = true
  }
}

export {validateText, validateSelect}
