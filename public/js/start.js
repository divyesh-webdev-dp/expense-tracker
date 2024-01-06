/**
 * Variables for modal elements and background colors.
 * @type {Object} modal - The modal element.
 * @type {Object} modalBody - The modal body element.
 * @type {Object} modalTitle - The modal title element.
 * @type {string} primaryBg - The background color for primary actions.
 * @type {string} dangerBg - The background color for danger or delete actions.
 */
var modal, modalBody, modalTitle;
var primaryBg, dangerBg;

$(document).ready(function(){
    modal = document.getElementById("showModal");
    modalTitle = document.getElementById("showModalLabel");
    modalBody = document.getElementById("cashFlowBody");
    primaryBg = "#5D87FF";
    dangerBg = "#FA896B";
});

/**
 * Display toastr notifications based on the provided type.
 *
 * @param {string} type - The type of notification (success, error, warning).
 * @param {string} title - The title of the notification.
 * @param {string} text - The text content of the notification.
 */
const showToastr = (type, title, text) => {
    // Options for toastr notifications
    let options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: true,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    // Display toastr notification based on the provided type

    if (type == "success") {
        toastr.success(text, title, options);
    } else if (type == "error") {
        toastr.error(text, title, options);
    } else if (type == "warning") {
        toastr.warning(text, title, options);
    }
};

/**
 * Display a SweetAlert modal with customizable options.
 *
 * @param {Object} swal - Configuration options for SweetAlert.
 * @param {Function} callback - A callback function to be executed if the user confirms the action.
*/
const sweetAlert = (swal, callback) => {
    Swal.fire({
        title: swal.title ?? "Are you sure?",
        text: swal.text ?? "You won't be able to revert this!",
        icon: swal.icon ?? "warning",
        showCancelButton: swal.showCancelButton ?? true,
        confirmButtonColor: swal.confirmButtonColor ?? primaryBg,
        cancelButtonColor: swal.cancelButtonColor ?? dangerBg,
        confirmButtonText: swal.confirmButtonText ?? "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
           // If the user confirmed, execute the callback function
            if (typeof callback === 'function') {
                callback();
            }
        }
    });
}

/**
 * Display a modal with the specified title and body content.
 *
 * @param {string} title - The title of the modal.
 * @param {string} body - The content to be displayed in the modal body.
 */
const showModal = (title, body) => {
    modalTitle.innerHTML = title;
    modalBody.innerHTML = body;
    // Show the modal using jQuery
    $('#showModal').modal("show");
}

/**
 * Close the currently displayed modal.
 */
const closeModal = () => {
    $("#showModal").modal("hide");
}

/**
 * Refresh the data table and reset bulk actions state.
 * - Reloads the DataTable.
 * - Unchecks the "Check All" checkbox.
 * - Clears bulk selection values.
 * - Hides bulk update options and shows bulk delete options.
 */
const refreshTable =  () => {
    $('#data-table').DataTable().ajax.reload();
    $("#checkAllBtn").prop("checked",false);
    $(".bulk-select").val("");
    $(".bulk-update").addClass("d-none");
    $(".bulk-delete").removeClass("d-none");
    $(".bulk-option").addClass("d-none");
}

/**
 * Event handler for the change event on the '#checkAllBtn' checkbox.
 * - If the checkbox is checked:
 *    - Show bulk options.
 *    - Check all individual checkboxes.
 *    - Clear bulk selection values.
 *    - Hide bulk update options and show bulk delete options.
 * - If the checkbox is unchecked:
 *    - Hide bulk options.
 *    - Uncheck all individual checkboxes.
 */
$('body').on('change','#checkAllBtn',function(){
    let checkAllBtn = $(this).prop("checked");
    if(checkAllBtn){
        $(".bulk-option").removeClass("d-none");
        $(".checkAll").prop("checked",true);
        $(".bulk-select").val("");
        $(".bulk-update").addClass("d-none");
        $(".bulk-delete").removeClass("d-none");
    }else{
        $(".bulk-option").addClass("d-none");
        $(".checkAll").prop("checked",false);
    }
});

/**
 * Event handler for the change event on '.bulk-select' select.
 * - When a bulk selection is made:
 * - Hide bulk delete options.
 * - Show bulk update options.
 */
$('body').on('change','.bulk-select',function(){
    $(".bulk-delete").addClass("d-none");
    $(".bulk-update").removeClass("d-none");
});
