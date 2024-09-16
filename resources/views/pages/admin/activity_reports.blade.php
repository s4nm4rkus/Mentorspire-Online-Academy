@extends(Auth::check() ? 'layouts.homelayout' : 'layouts.app')

@section('content')

<div class="container" style="color: initial !important; padding-bottom: 40px;">
    <div class="card">
        <div class="card-body">
            <div class="row mt-4">
                <div class="col">
                    <select id="datesDropdown" style="width: 150px; color: black"></select>
                    <a href="#" class="btn btn-sm btn-danger delete-date" style="display:none">Delete</a>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <table id="activity-reports-table" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Snoring Level</th>
                                <th>Heart Rate</th>
                                <th>SP02</th>
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
        
        let isAdmin = {{ Auth::user()->hasRole('admin') ? 'true' : 'false' }}
        
        var dataTable = new DataTable('#activity-reports-table', {
            ajax: {
                url: 'get-activity-reports',
                type: 'GET',
                data: function (d) {
                    d.date = $('#datesDropdown').val();
                }
            },
            processing: true,
            serverSide: true,
            columns: [
                { data: 'user.name', name: 'name' },
                { data: 'snoring_level', name: 'snoring_level' },
                { data: 'heart_rate', name: 'heart_rate' },
                { data: 'sp02', name: 'sp02' },
            ],
            columnDefs: [
                {
                    "targets": 0, // Target the third column (index starts from 0)
                    "visible": isAdmin // Show/hide based on condition
                },
            ]
        });

        var datesDropdown = $('#datesDropdown');
        datesDropdown.select2({
            ajax: {
                url: `get-activity-reports-dates`,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: moment(item.date).format('YYYY-MM-DD'),
                                id: moment(item.date).format('YYYY-MM-DD')
                            }
                        })
                    };
                },
                cache: true,
            },
            allowClear: true,
            placeholder: 'FILTER BY DATE'
        });

        datesDropdown.on("change", function (e) { 
            var selectedValue = $(this).val();

            if (selectedValue !== null) {
                $('.delete-date').show()
            } else {
                $('.delete-date').hide()
            }

            dataTable.ajax.reload();
        });

        $('.delete-date').on('click', function() {
            let date = $('#datesDropdown').val();
            $.confirm({
                title: 'Confirmation',
                content: `Are you sure you want to delete records on ${date}?`,
                theme: 'material', // You can choose a different theme if needed
                backgroundDismiss: true,
                buttons: {
                confirm: {
                    text: 'Yes',
                    btnClass: 'btn-red', // Use a predefined red button class
                    action: function() {
                        $.ajax({
                            url: '/activity-reports/' + date,
                            data: {
                                _token :'{{ csrf_token() }}', 
                            },
                            type: 'DELETE',
                            success: function(data) {
                                toastr.success(data.success);
                                $('#activity-reports-table').DataTable().ajax.reload();
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