var tableName = document.getElementById('tableNameId').innerHTML.split(' ');

var edit = false;
var save = false;

function enableInputFields(row) {
  const inputs = row.querySelectorAll('.form-control');
  inputs.forEach(input => {
    input.removeAttribute('disabled');
    input.style.color = "red";
    if (!input.hasAttribute('data-original-value')) {
        input.setAttribute('data-original-value', input.value);
    }
  });
  edit = true;
}

function disableInputFields(row) {
  const inputs = row.querySelectorAll('.form-control');
  inputs.forEach(input => {
    input.setAttribute('disabled', true);
    input.style.color = "white";
  });
}


function addEventListenersToButtons(row) {
    const editButton = row.querySelector('.edit-row');
    const saveButton = row.querySelector('.save-row');
    const deleteButton = row.querySelector('.delete-row');

    edit = false;

    editButton.addEventListener('click', () => {
      enableInputFields(row);
      editButton.style.display = 'none';
      saveButton.style.display = 'inline-block';
    });

    saveButton.addEventListener('click', () => {
      const inputs = row.querySelectorAll('.form-control');
      disableInputFields(row);
      saveButton.style.display = 'none';
      editButton.style.display = 'inline-block';

      const originalEnglish = inputs[0].getAttribute('data-original-value');
      const origHungarian1 = inputs[1].getAttribute('data-original-value');
      const origHungarian2 = inputs[2].getAttribute('data-original-value');
      const origHungarian3 = inputs[3].getAttribute('data-original-value');

      if (edit) {
        if (inputs[0].value !== originalEnglish || inputs[1].value !== origHungarian1 || inputs[2].value !== origHungarian2 || inputs[3].value !== origHungarian3) {
            updateCells(tableName[0], originalEnglish, inputs[0].value, origHungarian1,inputs[1].value, origHungarian2,inputs[2].value, origHungarian3, inputs[3].value);
        }
      }

      if (!edit) {
        console.log(inputs[0].value)
        if(inputs[0].value != null) actionCells('/szotar/addCells',"POST",tableName[0],inputs[0].value,inputs[1].value,inputs[2].value,inputs[3].value);
    }
    });

    deleteButton.addEventListener('click', () => {
          const row = deleteButton.parentNode.parentNode;
          const inputs = row.querySelectorAll('.form-control');
          row.parentNode.removeChild(row);
          actionCells('/szotar/deleteCells',"DELETE",tableName[0],inputs[0].value,inputs[1].value,inputs[2].value,inputs[3].value);
    });
}

//-----------Adding event listeners to all displayed buttons----------------------
$('#worked tbody tr').each(function(index, row) {
    addEventListenersToButtons(row);
  });

//------------------------new row-------------------------
  $(function () {
    $('#worked .add-row').click(function () {
      var template = '<tr><td><input class="form-control" type="text" /></td><td><input class="form-control" type="text" /></td><td><input class="form-control" type="text" /></td><td><input class="form-control" type="text" /></td><td><button type="button" class="btn btn-danger delete-row" style="margin-right: 14px">-</button><button type="button" class="btn btn-primary edit-row" style="display: none;">Szerkesztés</button><button type="button" class="btn btn-success save-row">Mentés</button></td></tr>';
      $('#worked tbody').append(template);
      const newRow = $('#worked tbody tr:last-child')[0];
      console.log(newRow);
      addEventListenersToButtons(newRow);
    });

    $('#worked').on('click', '.delete-row', function () {
      $(this).parent().parent().remove();
    });
  });



function actionCells(url, method, tableName, english, hun1, hun2, hun3){
    $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method : method,
        url : url,
        data : {
            tableName : tableName,
            english : english,
            hun1 : hun1,
            hun2 : hun2,
            hun3 : hun3
        },
        dataType: "json",
        success: function(xhr){
            toastr.success(xhr);
        },
        error: function(xhr){
            var errors = xhr.responseJSON.errors;
            if (errors) {
                toastr.error(Object.values(errors)[0][0]);
            } else {
                toastr.error(xhr.responseJSON);
            }
        }
    })
}


function updateCells(tableName, originalEnglish ,english, originalHun1, hun1, originalHun2, hun2, originalHun3, hun3){
    $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method : "PATCH",
        url : "/szotar/updateCells",
        data : {
            tableName : tableName,
            originalEnglish : originalEnglish,
            english : english,
            originalHun1 : originalHun1,
            hun1 : hun1,
            originalHun2 : originalHun2,
            hun2 : hun2,
            originalHun3 : originalHun3,
            hun3 : hun3,
        },
        dataType: "json",
        success: function(xhr){
            toastr.success(xhr);
        },
        error: function(xhr){
            var errors = xhr.responseJSON.errors;
            if (errors) {
                toastr.error(Object.values(errors)[0][0]);
            } else {
                toastr.error(xhr.responseJSON);
            }
        }
    })
}

const chatInputDiv = document.getElementById("chatInput");
chatInputDiv.style.display = "none";
