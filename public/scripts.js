onload = async () =>{
    function toast() {
        const divToast = document.getElementById('toast')
        const div = document.createElement('div')
        const p = document.createElement('p')
        p.style.textAlign = 'center'
        p.style.marginTop = '13px'
        div.append(p);
        divToast.append(div);

        p.innerHTML = 'Produto adicionado com sucesso!'
        setTimeout(function () {
            div.innerHTML = ''
        }, 4000)

        // ALTERAR ISSO AQUI
}
