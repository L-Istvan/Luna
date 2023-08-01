function submitModalInput() {
    var inputValue = document.getElementById('modalInput').value;

    if(inputValue === "" || inputValue === null){
        document.getElementById('error').innerHTML = "A tábla név hiányzik!";
    }

    else{
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "/szotar/createTable",
            data: {
                modalInput: inputValue
            },
            dataType: 'json',
            success: function(xhr){
                toastr.success(xhr.responseText);
                document.getElementById('modalInput').value = "";
            },
            error: function(xhr){
                toastr.error(xhr.responseText);
            }
        })
    }
}
