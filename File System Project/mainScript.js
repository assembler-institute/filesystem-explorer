function obtenerdatos(elem){
    fetch(elem)
    .then(respuesta => {
        return respuesta
    }).then(datos => {
        appendfile(datos.url)
    })

}

function appendfile(elem){
    asidefile= document.getElementById('asidefile');
    content=`<iframe src="${elem}"`
    asidefile.innerHTML = content;
};