let EmployeeTable = {
    actions: {
        deleteEmployee: function() {

        },
        editEmployee: function() {

        }
    },
    registerClickHandlers: function() {
        $('.btn.delete').click(EmployeeTable.actions.deleteEmployee);
        $('.btn.edit').click(EmployeeTable.actions.editEmployee);
    },
    attachPlugins: function() {
        $('time.timeago').timeago();
    }
};

$(document).ready(function() {
   EmployeeTable.registerClickHandlers();
   EmployeeTable.attachPlugins();
});