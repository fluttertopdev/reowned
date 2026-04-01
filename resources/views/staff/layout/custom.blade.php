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
          window.location.href = "{{ route('staffCategory.destroy', '') }}/" + itemId;
        } else if (pagename == 'adspackages') {
          window.location.href = "{{ route('staffAdvertisementpackage.destroy', '') }}/" + itemId;
        } else if (pagename == 'listingpackages') {
          window.location.href = "{{ route('staffitemPackages.destroy', '') }}/" + itemId;
        } else if (pagename == 'notification') {
          window.location.href = "{{ route('staffNotification.destroy', '') }}/" + itemId;
        } 

        else if (pagename == 'userqueries') {
          window.location.href = "{{ route('staffuserqueries.destroy', '') }}/" + itemId;
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
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize select2 with search enabled
        $('.select2').select2({
            placeholder: $(this).data('placeholder'),
            allowClear: true
        });

        function handleDropdownChange(dropdownId) {
            $(dropdownId).on('change', function () {
                let selectedValues = $(this).val();

                if (selectedValues && selectedValues.includes("select_all")) {
                    // Select all except "Select All" and "Deselect All"
                    $(this).val($(dropdownId + " option:not([value='select_all'], [value='deselect_all'])").map(function () {
                        return this.value;
                    }).get()).trigger('change');
                } else if (selectedValues && selectedValues.includes("deselect_all")) {
                    // Deselect all
                    $(this).val([]).trigger('change');
                }
            });
        }

        // Apply the function to both user and item dropdowns
        handleDropdownChange("#user-dropdown");
        handleDropdownChange("#item-dropdown");
    });
</script>

   <script type="text/javascript">
    function selectAllSameData(source_class, des_class) {
    var sourceChecked = $("." + source_class + ":checked").length > 0;

    if (sourceChecked) {
    $("." + des_class).prop("checked", true);
    } else {
    $("." + des_class).prop("checked", false);
    }
    }

  </script>