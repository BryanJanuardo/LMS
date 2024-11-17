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
                            // Clone the course card template
                            var $courseCard = $('#courseCardTemplate').clone().removeAttr('id').show();

                            // Populate the cloned card with course data
                            $courseCard.find('.course-title').text(course.title);
                            $courseCard.find('.course-code').text(course.courseCode);
                            $courseCard.find('.course-class').text(course.className);
                            $courseCard.find('.course-credits').text(course.credit);

                            // Set the progress bar and text
                            var progress = course.progress;
                            $courseCard.find('.progress-fill').css('width', progress + '%'); // Update width of progress bar
                            $courseCard.find('.course-progress').text(progress); // Set text for progress percentage

                            // Make the course card clickable
                            $courseCard.click(function () {
                                window.location.href = '/course/' + course.courseCode;
                            });

                            // Append the populated card to the course list
                            $('#courseList').append($courseCard);
                        });
                    } else {
                        $('#courseList').html('<p>No courses available for this semester.</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error: " + status + error); // Log the error
                    $('#courseList').html('<p>Error loading courses.</p>');
                }
            });
        } else {
            $('#courseList').empty();
        }
    });

    $('#semesterDropdown').change();
});


// $(document).ready(function () {
//     $('#semesterDropdown').change(function () {
//         var selectedPeriod = $(this).val();
//         if (selectedPeriod) {
//             $.ajax({
//                 url: '/courses/' + selectedPeriod, // Adjust the URL based on your route
//                 method: 'GET',
//                 success: function (data) {
//                     $('#courseList').empty();
//                     if (data.length > 0) {
//                         $.each(data, function (index, course) {
//                             // Clone the course card template
//                             var $courseCard = $('#courseCardTemplate').clone().removeAttr('id').show(); // Clone, remove ID, and show

//                             // Populate the cloned card with course data
//                             $courseCard.find('.course-title').text(course.title);
//                             $courseCard.find('.course-code').text(course.courseCode);
//                             $courseCard.find('.course-class').text(course.className);
//                             $courseCard.find('.course-credits').text(course.credit);

//                             // Set the progress bar and text
//                             var progress = course.progress;
//                             $courseCard.find('.progress-fill').css('width', progress + '%'); // Update width of progress bar
//                             $courseCard.find('.course-progress').text(progress); // Set text for progress percentage

//                             // Append the populated card to the course list
//                             $('#courseList').append($courseCard);
//                         });
//                     } else {
//                         $('#courseList').html('<p>No courses available for this semester.</p>');
//                     }
//                 },
//                 error: function (xhr, status, error) {
//                     console.error("AJAX Error: " + status + error); // Log the error
//                     $('#courseList').html('<p>Error loading courses.</p>');
//                 }
//             });
//         } else {
//             $('#courseList').empty(); // Clear courses if no period is selected
//         }
//     });

//     $('#semesterDropdown').change(); // This will load courses for the selected semester on page load
// });
