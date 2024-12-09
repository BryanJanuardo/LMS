$(document).ready(function () {
    $('#semesterDropdown').change(function () {
        var selectedPeriod = $(this).val();
        if (selectedPeriod) {
            $.ajax({
                url: '/courses/' + selectedPeriod,
                method: 'GET',
                success: function (data) {
                    $('#courseList').empty();
                    if (data.length > 0) {
                        $.each(data, function (index, course) {
                            var $courseCard = $('#courseCardTemplate').clone().removeAttr('id').show();

                            $courseCard.find('.course-title').text(course.title);
                            $courseCard.find('.course-code').text(course.courseCode);
                            $courseCard.find('.course-class').text(course.className);
                            $courseCard.find('.course-credits').text(course.credit);

                            var progress = course.progress;
                            $courseCard.find('.progress-fill').css('width', progress + '%');
                            $courseCard.find('.course-progress').text(progress);

                            $courseCard.click(function () {
                                window.location.href = '/course/' + course.courseCode;
                            });

                            $('#courseList').append($courseCard);
                        });
                    } else {
                        $('#courseList').html('<p>No courses available for this semester.</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error: " + status + error);
                    $('#courseList').html('<p>Error loading courses.</p>');
                }
            });
        } else {
            $('#courseList').empty();
        }
    });

    $('#semesterDropdown').change();
});
