Swal.fire({
    title: 'Error!',
    text: 'Do you want to continue',
    icon: 'error',
    confirmButtonText: 'Cool'
})
/* @if(Session::has('message'))
toastr.success("{{ session('message') }}")
@endif */
$(document).ready(function () {
    if ("{{Session::has('message')}}") {
        var message = "{{ session('message') }}"
        Swal.fire({
            title: 'Complete!',
            text: message,
            icon: 'success',
            confirmButtonText: 'Okay'
        })
    }
    /*  Swal.fire({
         title: 'Complete!',
         text: 'Do you want to continue',
         icon: 'success',
         confirmButtonText: 'Okay'
     }) */
})