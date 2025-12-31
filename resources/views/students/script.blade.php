<script>
    let currentSort = '';
    let currentDirection = 'asc';
    let currentPage = 1;
    let currentSearch = '';
    // add csrf token ajax request 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Sweet alert toaster
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });


    // Update current url as per sort or search and pagination
    function updateUrl() {
        const params = new URLSearchParams();

        if (currentSort) params.set('sort', currentSort);
        if (currentDirection) params.set('direction', currentDirection);
        if (currentSearch) params.set('search', currentSearch);
        if (currentPage > 1) params.set('page', currentPage);
        // console.log('currentPage', currentPage)
        history.pushState({}, '', '?' + params.toString());
    }

    // DEBOUNCED SEARCH
    let searchTimer = null;

    $('#search').on('keyup', function() {
        clearTimeout(searchTimer);

        searchTimer = setTimeout(() => {
            currentSearch = $(this).val();
            loadStudents(1); // reset page
        }, 400);
    });

    // fetch student list 
    function loadStudents(page = 1) {
        $.get('/students-list', {
            sort: currentSort,
            direction: currentDirection,
            search: currentSearch,
            page: page
        }, function(data) {
            $('#studentTable').html(data);
            updateUrl();
        });
    }

    $(document).ready(function() {

        const params = new URLSearchParams(window.location.search);

        currentSort = params.get('sort') || '';
        currentDirection = params.get('direction') || 'asc';
        currentPage = params.get('page') || 1;
        currentSearch = params.get('search') || '';
        $('#sort').val(currentSort);
        $('#direction').val(currentDirection);
        $('#search').val(currentSearch);

        loadStudents(currentPage);


        $('#applySort').click(function() {
            currentSort = $('#sort').val();
            currentDirection = $('#direction').val();
            currentSearch = $('#search').val();
            loadStudents($('#sort').val(), $('#direction').val());
        });

        $('#addBtn').click(function() {
            $('#studentForm')[0].reset();
            $('#student_id').val('');
            $('#modalTitle').text('Add Student');
            $('#studentModal').removeClass('hidden');
        });

        $('#closeModal').click(function() {
            $('#studentModal').addClass('hidden');
        });

        $(document).on('click', '.edit', function() {
            $('#student_id').val($(this).data('id'));
            $('#name').val($(this).data('name'));
            $('#age').val($(this).data('age'));
            $('#mark').val($(this).data('mark'));

            $('#modalTitle').text('Edit Student');
            $('#studentModal').removeClass('hidden');
        });

        // student form age and mark field validation  
        $('#age, #mark').on('input', function() {
            let value = parseInt($(this).val());

            if (value < 0 || isNaN(value)) {
                $(this).val('');
            }
        });


        $('#studentForm').submit(function(e) {
            e.preventDefault();

            $('.text-red-600').text(''); // clear errors

            let name = $('#name').val().trim();
            let age = $('#age').val();
            let mark = $('#mark').val();

            let valid = true;

            if (name === '') {
                $('#error-name').text('Name is required');
                valid = false;
            }

            if (age === '' || age <= 0) {
                $('#error-age').text('Age must be greater than 0');
                valid = false;
            }

            if (mark === '' || mark < 0 || mark > 100) {
                $('#error-mark').text('Mark must be between 0 and 100');
                valid = false;
            }

            if (!valid) return;
            let id = $('#student_id').val();
            let url = id ? `/students/${id}` : `/students`;
            let type = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: type,
                data: {
                    name,
                    age,
                    mark
                },
                success: function(res) {
                    $('#studentModal').addClass('hidden');
                    loadStudents();
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });

                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.name) $('#error-name').text(errors.name[0]);
                        if (errors.age) $('#error-age').text(errors.age[0]);
                        if (errors.mark) $('#error-mark').text(errors.mark[0]);
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong'
                        });

                    }
                }
            });
        });

        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This student will be permanently deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/students/${id}`,
                        type: 'DELETE',
                        success: function(response) {
                            loadStudents(currentPage);

                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                        },
                        error: function() {
                            Toast.fire({
                                icon: 'error',
                                title: 'Delete failed'
                            });
                        }
                    });
                }
            });
        });


    });

    // AJAX Pagination for student  data fetch
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        currentPage = new URL($(this).attr('href')).searchParams.get('page');
        loadStudents(currentPage);
    });

    // They start and stop loader  every ajax call 
    $(document).ajaxStart(function() {
        $('#loader').removeClass('hidden');
    });

    $(document).ajaxStop(function() {
        $('#loader').addClass('hidden');
    });
</script>