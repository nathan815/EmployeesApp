let EmployeeService = {
    deleteEmployee: function(id, successCallback, errorCallback) {
        $.ajax({
            url: '/api/employees/' + id,
            method: 'DELETE',
            dataType: 'json',
            success: successCallback
        });
    }
};

let EmployeeTable = {
    actions: {
        deleteEmployee: function(e) {
            e.preventDefault();
            let $row = $(this).closest('tr');
            let id = $row.data('id');
            if(!confirm('Do you really want to delete Employee #' + id + '?'))
                return;
            EmployeeService.deleteEmployee(id, function(data) {
                if(data.success) {
                    $row.remove();
                    StatusBox.warn('Deleted employee ' + id + ' successfully.', 2000);
                }
                else {
                    StatusBox.error(data.error, 2000);
                }
            });
        },
        editEmployee: function(e) {
            e.preventDefault();
            let id = $(this).closest('tr').data('id');
            alert(id)
        }
    },
    registerClickHandlers: function() {
        $('form.delete').on('submit', EmployeeTable.actions.deleteEmployee);
        //$('.btn.edit').on('click', EmployeeTable.actions.editEmployee);
    },
    attachPlugins: function() {
        $('time.timeago').timeago();
    }
};

let StatusBox = {
    currId: 0,
    add: function(msg, type, timeout) {
        let id = StatusBox.currId++;
        $('.content').prepend('<div id="status'+id+'" class="alert alert-' + type + '">' + msg + '</div>');
        setTimeout(function() {
            $('#status' + id).fadeOut();
        }, timeout);
    },
    error: function(msg, timeout) {
        StatusBox.add(msg, 'danger', timeout);
    },
    success: function(msg, timeout) {
        StatusBox.add(msg, 'success', timeout);
    },
    warn: function(msg, timeout) {
        StatusBox.add(msg, 'warning', timeout);
    },
    neutral: function(msg, timeout) {
        StatusBox.add(msg, 'secondary', timeout);
    },
};

$(document).ready(function() {
   EmployeeTable.registerClickHandlers();
   EmployeeTable.attachPlugins();
   $(document).ajaxError(function(e, jqXHR, settings) {
       let errMsg = 'Error: ';
       switch(jqXHR.status) {
           case 500:
                errMsg += 'Internal server error, try again later.';
               break;
           default:
               console.log(jqXHR.responseJSON);
               errMsg += jqXHR.responseText;
       }
       StatusBox.add(errMsg, 'danger', 2500);
   });
});