@extends(Auth::check() ? 'layouts.homelayout' : 'layouts.app')

@section('content')

<div class="container" style="color: initial !important; padding-bottom: 40px;">
    <div class="card">
        <div class="card-body">
            <div class="row mt-4">
                <div class="col">
                    <table id="contact-us-table" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
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

        var dataTable = new DataTable('#contact-us-table', {
            ajax: {
                url: 'get-contact-us',
                type: 'GET',
            },
            processing: true,
            serverSide: true,
            columns: [
                { data: 'full_name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'message', name: 'message' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });

        $('#contact-us-table').on('click', '.delete', function() {
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
                            url: '/contact-us/' + itemId,
                            data: {
                                _token :'{{ csrf_token() }}', 
                            },
                            type: 'DELETE',
                            success: function(data) {
                                toastr.success(data.success);
                                $('#contact-us-table').DataTable().ajax.reload();
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
    });
</script>
@endsection