function show_add(){
    
toastr.options = { "closeButton": true, "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass":
    "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeout": "5eee",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
toastr["info"]("Used added successfully", "Add user");
}
function show_del(){
    
toastr.options = { "closeButton": true, "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass":
    "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeout": "5eee",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
toastr["error"]("Used deleted successfully", "Delete user");
}
function edit(){
    
toastr.options = { "closeButton": true, "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass":
    "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeout": "5eee",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
toastr["success"]("Used updated successfully", "Update user");
}

function confirm_delete(id){
    let del=confirm("Do you confirm the delete ?");
    if(del){
        window.location.href="index.php?action=del&id="+id;
    }
}
function confirm_edit(id){
        window.location.href="add_user.php?action=del&id="+id;
}