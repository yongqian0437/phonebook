// $(document).ready(function () {
//     $("#table_course_applicant").DataTable({

//         ajax: {
//             url: base_url + "internal/level_2/education_agent/course_application/course_application_list",
//             type: "GET",
//         },
//         "columnDefs": [{
//             // "width": "15%",
//             // "targets": [6]
//         }
//         ]
//     });

// }); // end of ready function

// function delete_course(course_id){

//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!'
//       }).then((result) => {
//         if (result.isConfirmed) {

//             $.ajax({
//                 url: base_url + "internal/level_2/educational_partner/ep_courses/delete_course",
//                 method:"POST",
//                 data:{ course_id:course_id},
//                 success:function(data)
//                 {
//                     Swal.fire(
//                         'Deleted!',
//                         'Course has been deleted.',
//                         'success'
//                     )

//                     //reload datatable
//                     var xin_table = $("#table_courses").DataTable();
//                     xin_table.ajax.reload(null, false);
//                 }
//             });

//         }
//       })
// }

// function view_course(course_id) {

//     $.ajax({
//         url: base_url + "internal/level_2/educational_agent/ep_courses/view_course",
//         method: "POST",
//         data: { course_id: course_id },
//         success: function (data) {
//             $('#course_information').html(data);

//         }
//     });
// }