<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
  $(window).on('load', function() {




    @if(Session::has('success'))

    toastr['success']("{{ session('success') }}", {
      closeButton: true,
      tapToDismiss: false,
      rtl: isRtl
    });

    @endif

    @if(Session::has('error'))
    toastr['error']("{{ session('error') }}", {
      closeButton: true,
      tapToDismiss: false,
      rtl: isRtl
    });
    @endif

    @if(Session::has('info'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true
    };
    toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true
    };
    toastr.warning("{{ session('warning') }}");
    @endif

  });
  let slugEdited = false;

  document.getElementById("slug").addEventListener("input", function() {
    slugEdited = true;
  });

  function generateSlug() {
    if (slugEdited) return;

    let name = document.getElementById("name").value;
    let slug = name.toLowerCase()
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-');
    document.getElementById("slug").value = slug;
  }




  function showDeleteConfirmation(pagename, itemId) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
      customClass: {
        confirmButton: 'swal-confirm-button-class'
      }
    }).then((result) => {
      if (result.isConfirmed) {



        if (pagename == 'category') {
          window.location.href = "{{ route('category.destroy', '') }}/" + itemId;
        } else if (pagename == 'adspackages') {
          window.location.href = "{{ route('advertisement-package.destroy', '') }}/" + itemId;
        } else if (pagename == 'listingpackages') {
          window.location.href = "{{ route('item-listing-package.destroy', '') }}/" + itemId;
        } else if (pagename == 'tags') {
          window.location.href = "{{ route('tags.destroy', '') }}/" + itemId;
        } else if (pagename == 'blog') {
          window.location.href = "/admin/delete-blog/" + itemId;
          window.location.href = "{{ route('blogs.destroy', '') }}/" + itemId;

        } else if (pagename == 'cms') {
          window.location.href = "{{ route('cms.destroy', '') }}/" + itemId;
        } else if (pagename == 'faq') {
          window.location.href = "{{ route('faq.destroy', '') }}/" + itemId;
        } else if (pagename == 'slider') {
          window.location.href = "{{ route('slider.destroy', '') }}/" + itemId;
        } else if (pagename == 'tip') {
          window.location.href = "{{ route('tips.destroy', '') }}/" + itemId;
        } else if (pagename == 'country') {
          window.location.href = "{{ route('country.destroy', '') }}/" + itemId;
        } else if (pagename == 'state') {
          window.location.href = "{{ route('state.destroy', '') }}/" + itemId;
        } else if (pagename == 'city') {
          window.location.href = "{{ route('city.destroy', '') }}/" + itemId;
        } else if (pagename == 'area') {
          window.location.href = "{{ route('area.destroy', '') }}/" + itemId;
        } else if (pagename == 'language') {
          window.location.href = "{{ route('language.destroy', '') }}/" + itemId;
        } else if (pagename == 'staff') {
          window.location.href = "{{ route('staff.destroy', '') }}/" + itemId;
        } else if (pagename == 'notification') {
          window.location.href = "{{ route('notification.destroy', '') }}/" + itemId;
        } else if (pagename == 'seo') {
          window.location.href = "{{ route('seo.destroy', '') }}/" + itemId;
        }

      }

    });
  }


  document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('.form-password-toggle .input-group-text');

    eyeIcon.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      // Toggle eye icon
      if (type === 'password') {
        eyeIcon.innerHTML = '<i class="ti ti-eye-off"></i>';
      } else {
        eyeIcon.innerHTML = '<i class="ti ti-eye"></i>';
      }
    });
  });




  document.getElementById("upload").addEventListener("change", function(event) {
    const file = event.target.files[0]; // Get selected file
    if (file) {
      const reader = new FileReader(); // Create a FileReader
      reader.onload = function(e) {
        document.getElementById("uploadedAvatar").src = e.target.result; // Set image preview
      };
      reader.readAsDataURL(file); // Read file as data URL
    }
  });


  function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var output = document.getElementById('image-preview');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
<script type="text/javascript">
  function calculateFinalPrice() {
    let price = parseFloat(document.getElementById("multicol-price").value) || 0;
    let discount = parseFloat(document.getElementById("multicol-discount").value) || 0;

    let finalPrice = price - (price * discount / 100);
    document.getElementById("multicol-final-price").value = finalPrice.toFixed(2);
  }









  document.getElementById("multicol-price").addEventListener("input", calculateFinalPrice);
  document.getElementById("multicol-discount").addEventListener("input", calculateFinalPrice);
</script>

<script type="text/javascript">
  function toggleInput(type, show) {
    document.getElementById(type + '-input').style.display = show ? 'block' : 'none';
  }

  document.addEventListener("DOMContentLoaded", function() {
    // Set initial visibility based on existing data (for Edit case)
    toggleInput('days', document.getElementById('days-limited').checked);
    toggleInput('item', document.getElementById('item-limited').checked);
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    function loadStates(selectedState = null) {
      var country_id = $('#country').val();
      if (country_id) {
        $.ajax({
          url: "{{ route('get.states') }}",
          type: "GET",
          data: {
            country_id: country_id
          },
          success: function(data) {
            $('#state').empty().append('<option value="">Select State</option>');
            $.each(data, function(key, value) {
              $('#state').append('<option value="' + key + '"' + (selectedState == key ? ' selected' : '') + '>' + value + '</option>');
            });
            if (selectedState) loadCities(selectedState, $('#selected_city').val());
          }
        });
      } else {
        $('#state').empty().append('<option value="">Select State</option>');
      }
    }

    function loadCities(state_id, selectedCity = null) {
      if (state_id) {
        $.ajax({
          url: "{{ route('get.cities') }}",
          type: "GET",
          data: {
            state_id: state_id
          },
          success: function(data) {
            $('#city').empty().append('<option value="">Select City</option>');
            $.each(data, function(key, value) {
              $('#city').append('<option value="' + key + '"' + (selectedCity == key ? ' selected' : '') + '>' + value + '</option>');
            });
          }
        });
      } else {
        $('#city').empty().append('<option value="">Select City</option>');
      }
    }

    $('#country').change(function() {
      loadStates();
    });

    $('#state').change(function() {
      loadCities($(this).val());
    });

    if ($('#selected_country').val()) {
      $('#country').val($('#selected_country').val()).trigger('change');
      setTimeout(() => {
        loadStates($('#selected_state').val());
      }, 500);
    }
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.update-value').on('change', function() {
      const id = $(this).data('id'); // Get the ID from the data attribute
      const value = $(this).val(); // Get the value from the input

      $.ajax({
        url: "{{ route('translation.updatetranslation') }}",

        type: "POST",
        dataType: "JSON",
        data: {
          id: id,
          value: value,
          _token: '{{ csrf_token() }}' // Include CSRF token
        },
        success: function(res) {
          if (res.success) {
            // Show success toaster
            toastr.success(res.message || 'Translation updated successfully!');
          } else {
            // Show error toaster for failed update
            toastr.error(res.message || 'Failed to update translation.');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          // Show error toaster for unexpected errors
          toastr.error('An error occurred while updating the translation.');
        }
      });
    });
  });
</script>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
    var quillEditor = document.getElementById("full-editor"); // Get Quill editor div
    var descriptionTextarea = document.getElementById("description"); // Get hidden textarea
    var descriptionError = document.getElementById("description-error"); // Get error message span
    var form = document.getElementById("description-form");

    // Function to get content from Quill editor
    function getEditorContent() {
      return quillEditor.querySelector(".ql-editor").innerHTML.trim();
    }

    // Sync Quill content to hidden textarea before submitting
    function updateTextarea() {
      descriptionTextarea.value = getEditorContent();
    }

    // Live validation to check if editor is empty
    function validateDescription() {
      var content = getEditorContent();
      if (content === "" || content === "<p><br></p>") {
        descriptionError.textContent = "The description field is required.";
        descriptionTextarea.setCustomValidity("The description field is required.");
        return false;
      } else {
        descriptionError.textContent = "";
        descriptionTextarea.setCustomValidity("");
        return true;
      }
    }

    // Listen for changes inside the editor and update the hidden textarea
    quillEditor.addEventListener("input", function() {
      updateTextarea();
      validateDescription();
    });

    // Validate on form submit
    form.addEventListener("submit", function(event) {
      updateTextarea();
      if (!validateDescription()) {
        event.preventDefault(); // Prevent form submission if validation fails
      }
    });

    // Load existing content from textarea to editor on page load
    if (descriptionTextarea.value.trim() !== "") {
      quillEditor.querySelector(".ql-editor").innerHTML = descriptionTextarea.value;
    }
  });
</script>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("[id^='full-editor-']").forEach(function(editorDiv) {
      var languageCode = editorDiv.getAttribute("data-language-code");
      var textarea = document.getElementById("description-" + languageCode);

      const fullToolbar = [
        [{
            font: []
          },
          {
            size: []
          }
        ],
        ['bold', 'italic', 'underline', 'strike'],
        [{
            color: []
          },
          {
            background: []
          }
        ],
        [{
            script: 'super'
          },
          {
            script: 'sub'
          }
        ],
        [{
            header: '1'
          },
          {
            header: '2'
          },
          'blockquote',
          'code-block'
        ],
        [{
            list: 'ordered'
          },
          {
            list: 'bullet'
          },
          {
            indent: '-1'
          },
          {
            indent: '+1'
          }
        ],
        [{
          direction: 'rtl'
        }],
        ['link', 'image', 'video', 'formula'],
        ['clean']
      ];
      const quill = new Quill('#' + editorDiv.id, {
        bounds: '#' + editorDiv.id,
        placeholder: 'Type Something...',
        modules: {
          formula: true,
          toolbar: fullToolbar
        },
        theme: 'snow'
      });

      // Load existing content from textarea into Quill
      if (textarea.value) {
        quill.root.innerHTML = textarea.value;
      }

      // Ensure Quill content is updated to textarea
      quill.on('text-change', function() {
        textarea.value = quill.root.innerHTML.trim();
      });
    });

    // Prevent empty submissions
    document.querySelector("form").addEventListener("submit", function(event) {
      var isValid = true;

      document.querySelectorAll("[id^='description-']").forEach(function(textarea) {
        var errorElement = document.getElementById("error-" + textarea.getAttribute("data-language-code"));

        if (textarea.value.trim() === "" || textarea.value.trim() === "<p><br></p>") {
          errorElement.textContent = "The editor field is required.";
          isValid = false;
        } else {
          errorElement.textContent = "";
        }
      });

      if (!isValid) {
        event.preventDefault(); // Stop form submission
      }
    });
  });
</script>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    toggleFields();
  });

  function toggleFields() {
    let type = document.getElementById("type").value;

    let itemField = document.getElementById("item-field");
    let categoryField = document.getElementById("category-field");
    let linkField = document.getElementById("link-field");

    let itemInput = document.getElementById("item_value");
    let categoryInput = document.getElementById("category_value");
    let linkInput = document.getElementById("link_value");

    // Hide all fields initially
    itemField.classList.add("d-none");
    categoryField.classList.add("d-none");
    linkField.classList.add("d-none");

    // Ensure all inputs are NOT required by removing the attribute
    itemInput.removeAttribute("required");
    categoryInput.removeAttribute("required");
    linkInput.removeAttribute("required");

    // Ensure all inputs are disabled by default
    itemInput.setAttribute("disabled", "true");
    categoryInput.setAttribute("disabled", "true");
    linkInput.setAttribute("disabled", "true");

    if (type === "item") {
      itemField.classList.remove("d-none");
      itemInput.removeAttribute("disabled");
      itemInput.setAttribute("required", "required");
    } else if (type === "category") {
      categoryField.classList.remove("d-none");
      categoryInput.removeAttribute("disabled");
      categoryInput.setAttribute("required", "required");
    } else if (type === "externallink") {
      linkField.classList.remove("d-none");
      linkInput.removeAttribute("disabled");
      linkInput.setAttribute("required", "required");
    }
  }

  function updateValue(value) {
    document.getElementById("final_value").value = value;
  }
</script>