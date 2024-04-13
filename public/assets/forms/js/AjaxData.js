function getSubjects() {
     var class_id = document.getElementById("class_id").value;
     var formData = new FormData()
     formData.append('class_id', class_id);
     var option = [];
     $.ajax({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: "{{ route('staff_subjects.getSubject') }}",
         data: formData,
         type: 'POST',
         contentType: false,
         processData: false,
         success: function(data) {
             var option = ['<option value="">Select Subject</option>'];
             data.forEach(d => {
                 option.push('<option value=' + d.id + '>' + d.subject_name + '</option>');
             });
             $("#subject_id").html(option.join('')).trigger('chosen:updated');

         }
     });
 }