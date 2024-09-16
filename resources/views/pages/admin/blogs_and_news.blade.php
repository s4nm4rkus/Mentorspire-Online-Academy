@extends(Auth::check() ? 'layouts.homelayout' : 'layouts.app')

@section('content')

<div class="container" style="color: initial !important">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-end">
                    <button type="button" class="btn btn-orange-color create-blog-button">Create Blog</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <table id="blogs-and-news-table" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->

    <div 
        class="modal fade" 
        id="editModal" 
        tabindex="-1" 
        role="dialog" 
        aria-labelledby="editModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content border-white" style="background-color: #232222 !important; color: #fff;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="itemId" name="itemId" value="">
                        <div class="mb-3">
                            <label for="inputTitle" class="form-label" style="color: #fff;">Title</label>
                            <input type="text" class="form-control" id="inputTitle">
                        </div>
                        <div class="mb-3">
                            <label for="inputContent" class="form-label" style="color: #fff;">Content</label>
                            <textarea class="form-control" id="contentTextarea" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="isDefaultCheck">
                            <label class="form-check-label" for="isDefaultCheck" style="color: #fff;">
                                Is Default
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-orange-color" id="submit-edit-btn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-white" style="background-color: #232222 !important; color: #fff;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createForm">
                        <div class="mb-3">
                            <label for="inputTitle" class="form-label" style="color: #fff;">Title</label>
                            <input type="text" class="form-control" id="inputTitle">
                        </div>
                        <div class="mb-3">
                            <label for="inputContent" class="form-label" style="color: #fff;">Content</label>
                            <textarea class="form-control" id="contentTextarea" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <input class="form-check-input" type="checkbox" value="0" id="isDefaultCheck">
                            <label class="form-check-label" for="isDefaultCheck" style="color: #fff;">
                                Is Default
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-orange-color" id="submit-btn">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
<script>
    $(document).ready(function () {
        toastr.options = {
            'closeButton': true,
            'debug': false,
            'newestOnTop': false,
            'progressBar': false,
            'positionClass': 'toast-top-right',
            'preventDuplicates': false,
            'showDuration': '1000',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut',
        };

        new DataTable('#blogs-and-news-table', {
            ajax: 'get-blogs-and-news',
            processing: true,
            serverSide: true,
            columns: [
                { data: 'title', name: 'title' },
                { data: 'created_at', name: 'created_at' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#blogs-and-news-table').on('click', '.edit', function() {
            var itemId = $(this).data('id');
            $.ajax({
                url: '/blogs-and-news/' + itemId + '/edit',
                type: 'GET',
                success: function(data) {
                    $('#editModal #itemId').val(data.id)
                    $('#editModal #inputTitle').val(data.title)
                    $('#editModal #contentTextarea').val(data.blogs_news)
                    $('#editModal #isDefaultCheck').prop("checked", data.is_default ? true : false)
                    $('#editModal').modal('show');
                }
            });
        });

        $('#blogs-and-news-table').on('click', '.delete', function() {
            var itemId = $(this).data('id');
            $.confirm({
                title: 'Confirmation',
                content: 'Are you sure you want to delete this item?',
                theme: 'material', // You can choose a different theme if needed
                backgroundDismiss: true,
                buttons: {
                confirm: {
                    text: 'Yes',
                    btnClass: 'btn-red', // Use a predefined red button class
                    action: function() {
                        $.ajax({
                            url: '/blogs-and-news/' + itemId,
                            data: {
                                _token :'{{ csrf_token() }}', 
                            },
                            type: 'DELETE',
                            success: function(data) {
                                toastr.success(data.success);
                                $('#blogs-and-news-table').DataTable().ajax.reload();
                            }
                        });
                    }
                },
                cancel: {
                    text: 'No',
                    btnClass: 'btn-default', // Use a predefined default button class
                    action: function() {
                    // Add your action here for 'No'
                    }
                }
                }
            });
        });

        $('.create-blog-button').on('click', function(e) {
            $('#createModal #inputTitle').val("")
            $('#createModal #contentTextarea').val("")
            $('#createModal #isDefaultCheck').prop("checked", false);
            $('#createModal').modal('show');
        });

        $('#submit-btn').on('click', function(e) {
            e.preventDefault();
            let params = {
                _token :'{{ csrf_token() }}',
                title: $('#createModal #inputTitle').val(),
                blogs_news: $('#createModal #contentTextarea').val(),
                is_default: $('#createModal #isDefaultCheck').prop("checked") ? 1 : 0
            }

            var url = '/blogs-and-news';

            $.ajax({
                url: url,
                type: 'POST',
                data: params,
                success: function(response) {
                    toastr.success(response.success);
                    $('#createModal').modal('hide');
                    $('#blogs-and-news-table').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });

        $('#submit-edit-btn').on('click', function(e) {
            e.preventDefault();
            let params = {
                _token :'{{ csrf_token() }}',
                id: $('#editModal #itemId').val(),
                title: $('#editModal #inputTitle').val(),
                blogs_news: $('#editModal #contentTextarea').val(),
                is_default: $('#editModal #isDefaultCheck').prop("checked") ? 1 : 0
                
            }
            // Check if it's an edit or create request
            var url = '/blogs-and-news/' + params.id;

            $.ajax({
                url: url,
                type: 'PUT',
                data: params,
                success: function(response) {
                    toastr.success(response.success);
                    $('#editModal').modal('hide');
                    $('#blogs-and-news-table').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection