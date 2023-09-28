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
                toastr.success(xhr);
                document.getElementById('modalInput').value = "";
                getTableNames();
            },
            error: function(xhr){
                toastr.error(xhr.responseJSON.message);
                document.getElementById('modalInput').value = "";
            }
        })
    }
}

function deleteDictionary(){
    var selectedDictionary = document.getElementById("dictionarySelect").value;
    console.log(selectedDictionary);

    if(selectedDictionary != null){
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "DELETE",
            url: "/szotar/deleteDictionary",
            data: {
                dictionary: selectedDictionary
            },
            dataType: 'json',
            success: function(xhr){
                toastr.success(xhr);
                getTableNames();
            },
            error: function(xhr){
                toastr.error(xhr.responseJSON);
            }
        })
    }
}

function getTableNames(){
    var route1 = '/szotarbol_szavak_gyakorlas/';
    var route2 = '/szotar/';

    $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "GET",
        url: "/header",
        success: function(xhr){
            if (xhr['tableNames'] === 0){
                $('#dynamic-dropdown-practicingWords').append('<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#myModal">Nincsen még szótárod, hozz létre egyet</a>');
                $('#dynamic-dropdown-dictionary-edit').append('<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#myModal">Nincsen még szótárod, hozz létre egyet</a>');
                $('#dictionarySelect').append('<option></option>');
            }
            else{
                //clear contents of dropdown menu first
                $('#dynamic-dropdown-practicingWords').empty();
                $('#dynamic-dropdown-dictionary-edit').empty();
                $('#dictionarySelect').empty();

                //add contents to dropdown menus
                xhr['tableNames'].forEach(function(name) {
                    $('#dynamic-dropdown-practicingWords').append('<li><a class="dropdown-item" href="' + route1 + name + '">' + name + ' szótár</a></li>');
                });
                xhr['tableNames'].forEach(function(name) {
                    $('#dynamic-dropdown-dictionary-edit').append('<li><a class="dropdown-item" href="' + route2 + name + '">' + name + ' szótár</a></li>');
                });
                xhr['tableNames'].forEach(function(name){
                    $('#dictionarySelect').append('<option value='+ name + '>'+ name + '</option>');
                });
            }
        }
    });
}

getTableNames();
