window.onload=()=>{
    let xhr=new XMLHttpRequest()
    xhr.responseType='json';
    xhr.onload=()=>{
        console.log(xhr.responseText)
    }
    xhr.open('GET',"{{route('product.check')}}")
    
}