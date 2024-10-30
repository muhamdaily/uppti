"use strict";

var KTUsersPermissionsList = function () {
    var table, element;

    return {
        init: function () {
            element = document.querySelector("#kt_permissions_table");

            if (!element) return;

            // Set up date ordering
            element.querySelectorAll("tbody tr").forEach((row) => {
                const columns = row.querySelectorAll("td");
                const formattedDate = moment(columns[2].innerHTML, "DD MMM YYYY, LT").format();
                columns[2].setAttribute("data-order", formattedDate);
            });

            // Initialize DataTable
            table = $(element).DataTable({
                info: false,
                order: [],
                columnDefs: [
                    { orderable: false, targets: 1 },
                    { orderable: false, targets: 3 }
                ]
            });

            // Search functionality
            document.querySelector('[data-kt-permissions-table-filter="search"]').addEventListener("keyup", (event) => {
                table.search(event.target.value).draw();
            });

            // Delete row functionality
            element.querySelectorAll('[data-kt-permissions-table-filter="delete_row"]').forEach((deleteButton) => {
                deleteButton.addEventListener("click", (event) => {
                    event.preventDefault();

                    const row = event.target.closest("tr");
                    const rowText = row.querySelectorAll("td")[0].innerText;

                    Swal.fire({
                        text: `Are you sure you want to delete ${rowText}?`,
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((result) => {
                        if (result.value) {
                            Swal.fire({
                                text: `You have deleted ${rowText}!`,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            }).then(() => {
                                table.row($(row)).remove().draw();
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                text: `${rowText} was not deleted.`,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            });
                        }
                    });
                });
            });
        }
    };
}();

KTUtil.onDOMContentLoaded(() => {
    KTUsersPermissionsList.init();
});
