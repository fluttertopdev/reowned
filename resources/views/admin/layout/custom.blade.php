<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
  $(window).on('load', function () {

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

  document.getElementById("slug").addEventListener("input", function () {
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
        } else if (pagename == 'userqueries') {
          window.location.href = "{{ route('userqueries.destroy', '') }}/" + itemId;
        } else if (pagename == 'userqueries') {
          window.location.href = "{{ route('userqueries.destroy', '') }}/" + itemId;
        } else if (pagename == 'reportreason') {
          window.location.href = "{{ route('reportreason.destroy', '') }}/" + itemId;
        } else if (pagename == 'userreport') {
          window.location.href = "{{ route('userreport.destroy', '') }}/" + itemId;
        } else if (pagename == 'role') {
          window.location.href = "{{ route('role.destroy', '') }}/" + itemId;
        }
        
      }

    });
  }


  document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('.form-password-toggle .input-group-text');

    eyeIcon.addEventListener('click', function () {
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




  document.getElementById("upload").addEventListener("change", function (event) {
    const file = event.target.files[0]; // Get selected file
    if (file) {
      const reader = new FileReader(); // Create a FileReader
      reader.onload = function (e) {
        document.getElementById("uploadedAvatar").src = e.target.result; // Set image preview
      };
      reader.readAsDataURL(file); // Read file as data URL
    }
  });


  function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
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
    let inputField = document.querySelector(`[name="no_of_${type}"]`);
    let inputContainer = document.getElementById(type + '-input');

    if (show) {
      inputContainer.style.display = 'block';
      inputField.setAttribute('required', 'required');
    } else {
      inputContainer.style.display = 'none';
      inputField.removeAttribute('required');
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
    // Initial setup on page load
    toggleInput('days', document.getElementById('days-limited').checked);
    toggleInput('item', document.getElementById('item-limited').checked);

    // Add event listeners for radio button changes
    document.getElementById('days-limited').addEventListener('change', function () {
      toggleInput('days', true);
    });

    document.getElementById('days-unlimited').addEventListener('change', function () {
      toggleInput('days', false);
    });

    document.getElementById('item-limited').addEventListener('change', function () {
      toggleInput('item', true);
    });

    document.getElementById('item-unlimited').addEventListener('change', function () {
      toggleInput('item', false);
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function () {
    function loadStates(selectedState = null) {
      var country_id = $('#country').val();
      if (country_id) {
        $.ajax({
          url: "{{ route('get.states') }}",
          type: "GET",
          data: {
            country_id: country_id
          },
          success: function (data) {
            $('#state').empty().append('<option value="">Select State</option>');
            $.each(data, function (key, value) {
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
          success: function (data) {
            $('#city').empty().append('<option value="">Select City</option>');
            $.each(data, function (key, value) {
              $('#city').append('<option value="' + key + '"' + (selectedCity == key ? ' selected' : '') + '>' + value + '</option>');
            });
          }
        });
      } else {
        $('#city').empty().append('<option value="">Select City</option>');
      }
    }

    $('#country').change(function () {
      loadStates();
    });

    $('#state').change(function () {
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
  $(document).ready(function () {
    $('.update-value').on('change', function () {
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
        success: function (res) {
          if (res.success) {
            // Show success toaster
            toastr.success(res.message || 'Translation updated successfully!');
          } else {
            // Show error toaster for failed update
            toastr.error(res.message || 'Failed to update translation.');
          }
        },
        error: function (xhr, status, error) {
          console.error('Error:', error);
          // Show error toaster for unexpected errors
          toastr.error('An error occurred while updating the translation.');
        }
      });
    });
  });
</script>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function () {
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
    quillEditor.addEventListener("input", function () {
      updateTextarea();
      validateDescription();
    });

    // Validate on form submit
    form.addEventListener("submit", function (event) {
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

  // ====Ads===
    document.addEventListener("DOMContentLoaded", function () {
      var quillEditor = document.getElementById("full-editor"); // Get Quill editor div
      var descriptionTextarea = document.getElementById("description-ads"); // Get hidden textarea
      var descriptionError = document.getElementById("description-error-ads"); // Get error message span
      var form = document.getElementById("description-form-ads");

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
      quillEditor.addEventListener("input", function () {
        updateTextarea();
        validateDescription();
      });

      // Validate on form submit
      form.addEventListener("submit", function (event) {
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
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[id^='full-editor-']").forEach(function (editorDiv) {
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
      quill.on('text-change', function () {
        textarea.value = quill.root.innerHTML.trim();
      });
    });

    // Prevent empty submissions
    document.querySelector("form").addEventListener("submit", function (event) {
      var isValid = true;

      document.querySelectorAll("[id^='description-']").forEach(function (textarea) {
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

<script>
  function openImageModal(imgElement) {
    var modal = document.getElementById("imageZoomModal");
    var modalImg = document.getElementById("modalImage");
    modal.style.display = "flex";
    modalImg.src = imgElement.src;
  }

  function closeImageModal() {
    document.getElementById("imageZoomModal").style.display = "none";
  }
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


<script>
  function showImagePreview(event, previewId) {
    let reader = new FileReader();
    reader.onload = function () {
      document.getElementById(previewId).src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>



<script>
  $(document).ready(function () {
    // Capture row ID when opening the modal
    $('#assignpackage').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var rowId = button.data('id'); // Extract row ID from data-id
      $('#rowIdInput').val(rowId); // Assign row ID to hidden input
    });

    // Handle selection change
    $('#packageSelect').on('change', function () {
      var baseUrl = $(this).val(); // Get selected base URL
      var rowId = $('#rowIdInput').val(); // Get stored row ID

      if (baseUrl && rowId) {
        window.location.href = baseUrl + '/' + rowId; // Append / and row ID to URL and redirect
      }
    });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var assignPackageModal = document.getElementById('assignpackage');

    assignPackageModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; // Button that triggered the modal
      var rowId = button.getAttribute('data-id'); // Extract row ID
      document.getElementById('rowIdInput').value = rowId; // Assign to hidden input
    });
  });
</script>


<script>
  $(document).ready(function () {
    // Ensure only one checkbox is checked at a time
    $('.rowCheckbox').on('change', function () {
      $('.rowCheckbox').not(this).prop('checked', false);
    });

    // Open modal when "Assign Package" button is clicked
    $('#bulkDeleteForm button[type="submit"]').on('click', function (e) {
      e.preventDefault(); // Prevent form from submitting directly

      let selectedPackage = $('.rowCheckbox:checked').val();
      let userId = $('input[name="user_ids[]"]').val();

      if (!selectedPackage) {
        alert('Please select one package.');
        return;
      }

      // Set values in hidden fields inside the modal
      $('#modalUserIds').val(userId);
      $('#modalPackageIds').val(selectedPackage);

      // Open the modal
      $('#assignPackageModal').modal('show');
    });

    // Submit modal form
    $('#modalAssignForm').on('submit', function () {
      $('#assignPackageModal').modal('hide');
    });
  });
</script>


<script>
  $(document).ready(function () {
    $('.itemRowCheckbox').on('change', function () {
      $('.itemRowCheckbox').not(this).prop('checked', false);
    });

    $('#assignItemPackageBtn').on('click', function (e) {
      e.preventDefault();
      let selectedPackage = $('.itemRowCheckbox:checked').val();
      let userId = $('input[name="user_ids[]"]').val();

      if (!selectedPackage) {
        alert('Please select one package.');
        return;
      }

      $('#itemModalUserIds').val(userId);
      $('#itemModalPackageIds').val(selectedPackage);
      $('#assignItemPackageModal').modal('show');
    });

    $('#itemModalAssignForm').on('submit', function () {
      $('#assignItemPackageModal').modal('hide');
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    const fieldType = document.getElementById('fieldType');
    const optionsSection = document.getElementById('optionsSection');
    const minLengthWrapper = document.getElementById('minLengthWrapper');
    const maxLengthWrapper = document.getElementById('maxLengthWrapper');
    const optionsWrapper = document.getElementById('optionsWrapper');

    const optionTypes = ['radio', 'dropdown', 'checkbox'];
    const hideLengthTypes = ['file', 'radio', 'dropdown', 'checkbox'];

    function handleFieldType(type) {

      // 🔹 Hide Min/Max for specific types
      if (hideLengthTypes.includes(type)) {
        minLengthWrapper.style.display = 'none';
        maxLengthWrapper.style.display = 'none';
      } else {
        minLengthWrapper.style.display = 'block';
        maxLengthWrapper.style.display = 'block';
      }

      // 🔹 Show Options only for radio/dropdown/checkbox
      if (optionTypes.includes(type)) {
        optionsSection.style.display = 'block';
      } else {
        optionsSection.style.display = 'none';
        optionsWrapper.innerHTML = ''; // clear options
      }
    }

    // On change
    fieldType.addEventListener('change', function () {
      handleFieldType(this.value);
    });

    // On page load (important for edit mode)
    handleFieldType(fieldType.value);

  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    const addBtn = document.getElementById('addOption');
    const wrapper = document.getElementById('optionsWrapper');

    addBtn.addEventListener('click', function () {

      const div = document.createElement('div');
      div.classList.add('d-flex', 'mb-2', 'option-item');

      div.innerHTML = `
            <input type="text" name="options[]" class="form-control me-2">
            <button type="button" class="btn btn-danger btn-sm removeOption">
                <i class="ti ti-x"></i>
            </button>
        `;

      wrapper.appendChild(div);
    });

    // Remove Option
    wrapper.addEventListener('click', function (e) {
      if (e.target.closest('.removeOption')) {
        e.target.closest('.option-item').remove();
      }
    });

  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    // Toggle child dropdown
    document.querySelectorAll('.toggle-child').forEach(button => {

      button.addEventListener('click', function () {

        const targetId = this.dataset.target;
        const childDiv = document.getElementById(targetId);
        const icon = this.querySelector('i');

        if (!childDiv) return;

        if (childDiv.style.display === 'none' || childDiv.style.display === '') {
          childDiv.style.display = 'block';
          icon.classList.remove('ti-chevron-right');
          icon.classList.add('ti-chevron-down');
        } else {
          childDiv.style.display = 'none';
          icon.classList.remove('ti-chevron-down');
          icon.classList.add('ti-chevron-right');
        }

      });

    });

    // Parent check → check/uncheck children
    document.querySelectorAll('.parent-checkbox').forEach(parent => {

      parent.addEventListener('change', function () {

        const parentId = this.dataset.parent;

        document.querySelectorAll(`[data-child-of="${parentId}"]`)
          .forEach(child => {
            child.checked = this.checked;
          });

      });

    });

    // Child check → auto check parent
    document.querySelectorAll('.child-checkbox').forEach(child => {

      child.addEventListener('change', function () {

        const parentId = this.dataset.childOf;
        const parentCheckbox = document.querySelector(`[data-parent="${parentId}"]`);

        const siblings = document.querySelectorAll(`[data-child-of="${parentId}"]`);

        const anyChecked = Array.from(siblings).some(cb => cb.checked);

        if (parentCheckbox) {
          parentCheckbox.checked = anyChecked;
        }

      });

    });

  });
</script>

<script>
  function openVerificationModal(front, back) {

    let frontPath = front ?
      "{{ url('uploads/user') }}/" + front :
      "{{ asset('uploads/Image-not-found.png') }}";

    let backPath = back ?
      "{{ url('uploads/user') }}/" + back :
      "{{ asset('uploads/Image-not-found.png') }}";

    document.getElementById('idFrontImage').src = frontPath;
    document.getElementById('idBackImage').src = backPath;

    var myModal = new bootstrap.Modal(document.getElementById('verificationModal'));
    myModal.show();
  }
</script>

<script>
  // Select All
  $('#selectAll').on('change', function () {
    $('.rowCheckbox').prop('checked', $(this).prop('checked'));
  });

  // Bulk Delete
  $('#bulkDeleteBtn').on('click', function () {

    let selected = [];

    $('.rowCheckbox:checked').each(function () {
      selected.push($(this).val());
    });

    // If nothing selected
    if (selected.length === 0) {
      Swal.fire({
        icon: 'warning',
        title: "{{ __('lang.warning') }}",
        text: "{{ __('lang.please_select_at_least_one_record') }}",
        confirmButtonText: "{{ __('lang.ok') }}"
      });
      return;
    }

    // Confirmation
    Swal.fire({
      title: "{{ __('lang.are_you_sure') }}",
      text: "{{ __('lang.you_wont_be_able_to_revert_this') }}",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: "{{ __('lang.yes_delete_it') }}",
      cancelButtonText: "{{ __('lang.cancel') }}"
    }).then((result) => {
      if (result.isConfirmed) {

        $.ajax({
          url: "{{ route('notification.bulkDelete') }}",
          type: "POST",
          data: {
            ids: selected,
            _token: "{{ csrf_token() }}"
          },
          success: function (response) {

            Swal.fire({
              icon: 'success',
              title: "{{ __('lang.deleted') }}",
              text: response.message,
              confirmButtonText: "{{ __('lang.ok') }}"
            }).then(() => {
              location.reload();
            });

          }
        });

      }
    });

  });
</script>