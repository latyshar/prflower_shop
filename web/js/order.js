function order_confirm()
{
    let password = document.getElementById("pass").value;

    var formdata = new FormData();
    formdata.append("password", password);

    var requestOptions = {
        method: 'POST',
        body: formdata
    };

    fetch('https://pr-latisheva.сделай.site/order/create', requestOptions)
        .then(response=>response.text())

        .then(result=>
        {
            console.log(result)
            let title=document.getElementById('staticBackdropLabel');
            let body=document.getElementById('modalBody');

            if (result=='false')
            {
                title.innerText='Ошибка';
                body.innerHTML="<p>Ошибка при оформлении заказа. Вероятно, Вы ввели неправильный пароль.</p><p>Попробуйте снова.</p>"
            }
            else
            {
                document.location.href='https://pr-latisheva.сделай.site/order/index'
            }

            let myModal = new
            bootstrap.Modal(document.getElementById("staticBackdrop"), {});
            myModal.show();
        })
}