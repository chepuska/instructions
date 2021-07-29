function changeAttr(){
    let a = document.querySelector('.search');
    console.log(a);
    a.addEventListener('input', function() {
        let b = document.querySelector('.send');
        b.disabled = '';
    });
}
changeAttr();
