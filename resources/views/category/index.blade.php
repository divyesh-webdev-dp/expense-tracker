<x-master>
    <x-sidebar />
    <div class="body-wrapper">
        <x-navbar />
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title fw-semibold mb-4">Category</h5>
                    <button class="btn btn-primary mb-3" onclick="createHandler()">Add Category</button>
                </div>
                <div class="card-body table-responsive">
                    {{ $dataTable->table() }}
                </div>
                <div class="card-footer bg-white">
                    <div class="bulk-option d-flex d-none">
                        <div class="col-sm-2">
                            <select class="form-select bulk-select">
                                <option disabled selected value="">Select option</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button class="btn border-danger text-danger mx-1 bulk-delete" onclick="bulkDeleteHandler()">
                            <i class="ti ti-trash fs-5"></i>
                        </button>
                        <button class="btn border-primary text-primary mx-1 bulk-update d-none"
                            onclick="bulkUpdateHandler()">
                            <i class="ti ti-edit fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        {!! $dataTable->scripts() !!}
        <script>
            /**
             * AJAX handler for creating a new category.
             * - Sends a request to the 'category.create' route.
             * - On success, displays a modal for adding a new category with the response content.
             * - On error, logs the error to the console.
             */
            const createHandler = () => {
                let url = "{{ route('category.create') }}";
                $.ajax({
                    url: url,
                    success: function(response) {
                        showModal('Add Category', response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            };
            /**
             * AJAX handler for editing a existing category.
             * @param {number} id - The ID of the category to be edited.
             * - Sends a request to the 'category.edit' route.
             * - On success, displays a modal for editing a existing category with the response content.
             * - On error, logs the error to the console.
             */
            const editHandler = (id) => {
                let url = "{{ route('category.edit', '/id') }}";
                url = url.replace('/id', id);
                $.ajax({
                    url: url,
                    success: function(response) {
                        showModal('Edit Category', response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            };
            /**
             * addHandler Function
             * - Sends a request to the 'category.store' route.
             * Handles the creating of a category using AJAX.
             */
            const addHandler = () => {
                let url = "{{ route('category.store') }}";
                let formData = $("#addCategory").serialize();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        refreshTable();
                        closeModal();
                        console.log(response);
                        showToastr('success', 'Success', response.message);
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            let errors = response.responseJSON.errors;
                            Object.entries(errors).forEach(([field, message]) => {
                                $(`#err-${field}`).text(message);
                            });
                        } else {
                            showToastr('error', 'Error', response);
                        }
                    }
                });
            };
            /**
             * updateHandler Function
             * - Sends a request to the 'category.update' route.
             * Handles the update of a category using AJAX.
             * @param {number} id - The ID of the category to be updated.
             */
            const updateHandler = (id) => {
                let url = "{{ route('category.update', '/id') }}";
                url = url.replace('/id', id);
                let formData = $("#editCategory").serialize();
                $.ajax({
                    url: url,
                    type: "PUT",
                    data: formData,
                    success: function(response) {
                        refreshTable();
                        closeModal();
                        showToastr('success', 'Success', response.message);
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            let errors = response.responseJSON.errors;
                            Object.entries(errors).forEach(([field, message]) => {
                                $(`#err-${field}`).text(message);
                            });
                        } else {
                            showToastr('error', 'Error', response);
                        }
                    }
                });
            };
            /**
             * deleteHandler Function
             * - Sends a request to the 'category.destroy' route.
             * Handles the deletion of a category using AJAX.
             * @param {number} id - The ID of the category to be deleted.
             */
            const deleteHandler = (id) => {
                let url = "{{ route('category.destroy', '/id') }}";
                url = url.replace('/id', id);
                sweetAlert({}, () => {
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        success: function(response) {
                            refreshTable();
                            showToastr('success', 'Success', response.message);
                        },
                        error: function(response) {

                        }
                    })
                });
            };
            /**
             * bulkDeleteHandler Function
             * - Sends a request to the 'category.bulkDelete' route.
             * Handles the bulk deletion of categories using AJAX.
             */
            const bulkDeleteHandler = () => {
                let url = "{{ route('category.bulkDelete') }}";
                let ids = [];
                ids = $('.checkAll:checked').map(function() {
                    return $(this).val();
                }).get();
                sweetAlert({}, () => {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            ids: ids
                        },
                        success: function(response) {
                            refreshTable();
                            showToastr('success', 'Success', response.message);
                        },
                        error: function(response) {

                        }
                    })
                });
            };
            /**
             * bulkUpdateHandler Function
             * - Sends a request to the 'category.bulkUpdate' route.
             * Handles the bulk update of categories status using AJAX.
             */
            const bulkUpdateHandler = () => {
                let url = "{{ route('category.bulkUpdate') }}";
                let ids = [];
                ids = $('.checkAll:checked').map(function() {
                    return $(this).val();
                }).get();
                let status = $(".bulk-select").val();
                sweetAlert({
                    icon: 'info',
                    confirmButtonText: "Yes, update it!"
                }, () => {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            ids: ids,
                            status: status
                        },
                        success: function(response) {
                            refreshTable();
                            showToastr('success', 'Success', response.message);
                        },
                        error: function(response) {

                        }
                    })
                });
            };
        </script>
    @endpush
</x-master>
