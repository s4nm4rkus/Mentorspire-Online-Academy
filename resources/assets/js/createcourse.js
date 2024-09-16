document.addEventListener('DOMContentLoaded', function () {
    // Display image preview when file is selected
    document.getElementById('image').addEventListener('change', function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('img-preview').src = e.target.result;
                document.getElementById('img-preview').style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
});

// view course
function viewCourse(courseId) {
    // Make an AJAX request to fetch the specific course details
    fetch(`/course/${courseId}`)
        .then(response => response.json())
        .then(data => {
            // Update the viewcourse section with the fetched course details
            document.getElementById('viewcourse').innerHTML = `
                <div class="d-flex coursedetails" style="height: auto;">
                    <div class="course_img" style="height: 10rem; width: 15rem; border: solid 1px; border-color: #2c96e1">
                        <img class="course_poster" src="${data.course_poster}" alt="...">
                    </div>
                    <div class="course_details">
                        <h5 class="card-title">${data.course_title}</h5>
                        <p class="course_description">${data.course_description}</p>
                        <h5 class="card-title mt-3">Course Code</h5>
                        <p class="course_code">${data.course_code}</p>
                    </div>
                </div>
            `;
        })
        .catch(error => console.error('Error:', error));
}

// Activity Tabs

document.addEventListener('DOMContentLoaded', function () {
    var tabs = document.querySelectorAll(".tabs li a");

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function (event) {
            event.preventDefault();
            var content = this.hash.replace('/', '');
            tabs.forEach(function (tab) {
                tab.classList.remove("active");
            });
            this.classList.add("active");
            document.querySelectorAll("#content p").forEach(function (p) {
                p.style.display = 'none';
            });
            document.querySelector(content).style.display = 'block';
        });
    });
});



// drop and drag
document.addEventListener('DOMContentLoaded', function () {
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');
    const uploadForm = document.getElementById('uploadForm');

    let filesArray = [];

    dropzone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropzone.classList.remove('dragover');
        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    dropzone.addEventListener('click', (event) => {
        if (event.target.id !== 'fileInput' && !event.target.classList.contains('remove-btn')) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    uploadForm.addEventListener('submit', (event) => {
        event.preventDefault();
        submitForm();
    });

    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!filesArray.some(f => f.name === file.name)) {
                filesArray.push(file);
                displayFile(file);
            }
        }
    }

    function displayFile(file) {
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-item');

        let filePreview;
        if (file.type.startsWith('image/')) {
            filePreview = document.createElement('img');
            filePreview.src = URL.createObjectURL(file);
        } else if (file.type.startsWith('video/')) {
            filePreview = document.createElement('video');
            filePreview.src = URL.createObjectURL(file);
            filePreview.controls = true;
        } else {
            // If it's not an image or video, show a placeholder
            filePreview = document.createElement('div');
            filePreview.classList.add('doc-preview');
            filePreview.textContent = file.name; // Placeholder for document
        }

        fileItem.appendChild(filePreview);

        const removeBtn = document.createElement('button');
        removeBtn.classList.add('remove-btn');
        removeBtn.innerHTML = '&times;';
        fileItem.appendChild(removeBtn);

        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerHTML = `
            <strong>Name:</strong> ${file.name}<br>
            <strong>Size:</strong> ${(file.size / 1024).toFixed(2)} KB
        `;
        fileItem.appendChild(tooltip);

        fileList.appendChild(fileItem);

        removeBtn.addEventListener('click', () => {
            fileList.removeChild(fileItem);
            filesArray = filesArray.filter(f => f !== file);
            URL.revokeObjectURL(filePreview.src);
        });

        fileItem.addEventListener('mouseenter', () => {
            tooltip.classList.add('show');
        });

        fileItem.addEventListener('mouseleave', () => {
            tooltip.classList.remove('show');
        });
    }

    function submitForm() {
        const formData = new FormData(uploadForm);
        filesArray.forEach(file => formData.append('handsout[]', file));

        fetch(uploadForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Handle success response
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error response
            });
    }
});


// drop and drag
document.addEventListener('DOMContentLoaded', function () {
    const dropzone = document.getElementById('dropzone2');
    const fileInput = document.getElementById('fileInput2');
    const fileList = document.getElementById('fileList2');
    const uploadForm = document.getElementById('uploadForm');

    let filesArray = [];

    dropzone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropzone.classList.remove('dragover');
        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    dropzone.addEventListener('click', (event) => {
        if (event.target.id !== 'fileInput2' && !event.target.classList.contains('remove-btn')) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    uploadForm.addEventListener('submit', (event) => {
        event.preventDefault();
        submitForm();
    });

    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!filesArray.some(f => f.name === file.name)) {
                filesArray.push(file);
                displayFile(file);
            }
        }
    }

    function displayFile(file) {
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-item');

        let filePreview;
        if (file.type.startsWith('image/')) {
            filePreview = document.createElement('img');
            filePreview.src = URL.createObjectURL(file);
        } else if (file.type.startsWith('video/')) {
            filePreview = document.createElement('video');
            filePreview.src = URL.createObjectURL(file);
            filePreview.controls = true;
        } else {
            // If it's not an image or video, show a placeholder
            filePreview = document.createElement('div');
            filePreview.classList.add('doc-preview');
            filePreview.textContent = file.name; // Placeholder for document
        }

        fileItem.appendChild(filePreview);

        const removeBtn = document.createElement('button');
        removeBtn.classList.add('remove-btn');
        removeBtn.innerHTML = '&times;';
        fileItem.appendChild(removeBtn);

        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerHTML = `
            <strong>Name:</strong> ${file.name}<br>
            <strong>Size:</strong> ${(file.size / 1024).toFixed(2)} KB
        `;
        fileItem.appendChild(tooltip);

        fileList.appendChild(fileItem);

        removeBtn.addEventListener('click', () => {
            fileList.removeChild(fileItem);
            filesArray = filesArray.filter(f => f !== file);
            URL.revokeObjectURL(filePreview.src);
        });

        fileItem.addEventListener('mouseenter', () => {
            tooltip.classList.add('show');
        });

        fileItem.addEventListener('mouseleave', () => {
            tooltip.classList.remove('show');
        });
    }

    function submitForm() {
        const formData = new FormData(uploadForm);
        filesArray.forEach(file => formData.append('handsout[]', file));

        fetch(uploadForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Handle success response
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error response
            });
    }
});


// drop and drag
document.addEventListener('DOMContentLoaded', function () {
    const dropzone = document.getElementById('dropzone3');
    const fileInput = document.getElementById('fileInput3');
    const fileList = document.getElementById('fileList3');
    const uploadForm = document.getElementById('uploadForm');

    let filesArray = [];

    dropzone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropzone.classList.remove('dragover');
        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    dropzone.addEventListener('click', (event) => {
        if (event.target.id !== 'fileInput3' && !event.target.classList.contains('remove-btn')) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    uploadForm.addEventListener('submit', (event) => {
        event.preventDefault();
        submitForm();
    });

    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!filesArray.some(f => f.name === file.name)) {
                filesArray.push(file);
                displayFile(file);
            }
        }
    }

    function displayFile(file) {
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-item');

        let filePreview;
        if (file.type.startsWith('image/')) {
            filePreview = document.createElement('img');
            filePreview.src = URL.createObjectURL(file);
        } else if (file.type.startsWith('video/')) {
            filePreview = document.createElement('video');
            filePreview.src = URL.createObjectURL(file);
            filePreview.controls = true;
        } else {
            // If it's not an image or video, show a placeholder
            filePreview = document.createElement('div');
            filePreview.classList.add('doc-preview');
            filePreview.textContent = file.name; // Placeholder for document
        }

        fileItem.appendChild(filePreview);

        const removeBtn = document.createElement('button');
        removeBtn.classList.add('remove-btn');
        removeBtn.innerHTML = '&times;';
        fileItem.appendChild(removeBtn);

        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerHTML = `
            <strong>Name:</strong> ${file.name}<br>
            <strong>Size:</strong> ${(file.size / 1024).toFixed(2)} KB
        `;
        fileItem.appendChild(tooltip);

        fileList.appendChild(fileItem);

        removeBtn.addEventListener('click', () => {
            fileList.removeChild(fileItem);
            filesArray = filesArray.filter(f => f !== file);
            URL.revokeObjectURL(filePreview.src);
        });

        fileItem.addEventListener('mouseenter', () => {
            tooltip.classList.add('show');
        });

        fileItem.addEventListener('mouseleave', () => {
            tooltip.classList.remove('show');
        });
    }

    function submitForm() {
        const formData = new FormData(uploadForm);
        filesArray.forEach(file => formData.append('handsout[]', file));

        fetch(uploadForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Handle success response
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error response
            });
    }
});



// drop and drag activity files 
document.addEventListener('DOMContentLoaded', function () {
    const dropzone = document.getElementById('dropzone4');
    const fileInput = document.getElementById('fileInput4');
    const fileList = document.getElementById('fileList4');
    const uploadForm = document.getElementById('uploadForm');

    let filesArray = [];

    dropzone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropzone.classList.remove('dragover');
        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    dropzone.addEventListener('click', (event) => {
        if (event.target.id !== 'fileInput4' && !event.target.classList.contains('remove-btn')) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    uploadForm.addEventListener('submit', (event) => {
        event.preventDefault();
        submitForm();
    });

    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!filesArray.some(f => f.name === file.name)) {
                filesArray.push(file);
                displayFile(file);
            }
        }
    }

    function displayFile(file) {
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-item');

        let filePreview;
        if (file.type.startsWith('image/')) {
            filePreview = document.createElement('img');
            filePreview.src = URL.createObjectURL(file);
        } else if (file.type.startsWith('video/')) {
            filePreview = document.createElement('video');
            filePreview.src = URL.createObjectURL(file);
            filePreview.controls = true;
        } else {
            // If it's not an image or video, show a placeholder
            filePreview = document.createElement('div');
            filePreview.classList.add('doc-preview');
            filePreview.textContent = file.name; // Placeholder for document
        }

        fileItem.appendChild(filePreview);

        const removeBtn = document.createElement('button');
        removeBtn.classList.add('remove-btn');
        removeBtn.innerHTML = '&times;';
        fileItem.appendChild(removeBtn);

        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerHTML = `
            <strong>Name:</strong> ${file.name}<br>
            <strong>Size:</strong> ${(file.size / 1024).toFixed(2)} KB
        `;
        fileItem.appendChild(tooltip);

        fileList.appendChild(fileItem);

        removeBtn.addEventListener('click', () => {
            fileList.removeChild(fileItem);
            filesArray = filesArray.filter(f => f !== file);
            URL.revokeObjectURL(filePreview.src);
        });

        fileItem.addEventListener('mouseenter', () => {
            tooltip.classList.add('show');
        });

        fileItem.addEventListener('mouseleave', () => {
            tooltip.classList.remove('show');
        });
    }

    function submitForm() {
        const formData = new FormData(uploadForm);
        filesArray.forEach(file => formData.append('handsout[]', file));

        fetch(uploadForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Handle success response
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error response
            });
    }
});




// drop and drag activity image 
document.addEventListener('DOMContentLoaded', function () {
    const dropzone = document.getElementById('dropzone5');
    const fileInput = document.getElementById('fileInput5');
    const fileList = document.getElementById('fileList5');
    const uploadForm = document.getElementById('uploadForm');

    let filesArray = [];

    dropzone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropzone.classList.remove('dragover');
        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    dropzone.addEventListener('click', (event) => {
        if (event.target.id !== 'fileInput5' && !event.target.classList.contains('remove-btn')) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    uploadForm.addEventListener('submit', (event) => {
        event.preventDefault();
        submitForm();
    });

    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!filesArray.some(f => f.name === file.name)) {
                filesArray.push(file);
                displayFile(file);
            }
        }
    }

    function displayFile(file) {
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-item');

        let filePreview;
        if (file.type.startsWith('image/')) {
            filePreview = document.createElement('img');
            filePreview.src = URL.createObjectURL(file);
        } else if (file.type.startsWith('video/')) {
            filePreview = document.createElement('video');
            filePreview.src = URL.createObjectURL(file);
            filePreview.controls = true;
        } else {
            // If it's not an image or video, show a placeholder
            filePreview = document.createElement('div');
            filePreview.classList.add('doc-preview');
            filePreview.textContent = file.name; // Placeholder for document
        }

        fileItem.appendChild(filePreview);

        const removeBtn = document.createElement('button');
        removeBtn.classList.add('remove-btn');
        removeBtn.innerHTML = '&times;';
        fileItem.appendChild(removeBtn);

        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerHTML = `
            <strong>Name:</strong> ${file.name}<br>
            <strong>Size:</strong> ${(file.size / 1024).toFixed(2)} KB
        `;
        fileItem.appendChild(tooltip);

        fileList.appendChild(fileItem);

        removeBtn.addEventListener('click', () => {
            fileList.removeChild(fileItem);
            filesArray = filesArray.filter(f => f !== file);
            URL.revokeObjectURL(filePreview.src);
        });

        fileItem.addEventListener('mouseenter', () => {
            tooltip.classList.add('show');
        });

        fileItem.addEventListener('mouseleave', () => {
            tooltip.classList.remove('show');
        });
    }

    function submitForm() {
        const formData = new FormData(uploadForm);
        filesArray.forEach(file => formData.append('handsout[]', file));

        fetch(uploadForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Handle success response
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error response
            });
    }
});

// Function to toggle label visibility based on file selection
function toggleLabelVisibility(fileInput, uploadLabel) {
    if (!fileInput.value) {
        uploadLabel.style.display = 'block';
    } else {
        uploadLabel.style.display = 'none';
    }
}

// Get references to elements for dropzone4
const dropzone4 = document.getElementById('dropzone4');
const uploadLabel4 = document.getElementById('uploadLabel4');
const fileInput4 = document.getElementById('fileInput4');

// Add event listener for file input change for dropzone4
fileInput4.addEventListener('change', function () {
    toggleLabelVisibility(fileInput4, uploadLabel4);
});

// Add event listener for input event to handle the case when files are removed for dropzone4
fileInput4.addEventListener('input', function () {
    toggleLabelVisibility(fileInput4, uploadLabel4);
});

// Get references to elements for dropzone5
const dropzone5 = document.getElementById('dropzone5');
const uploadLabel5 = document.getElementById('uploadLabel5');
const fileInput5 = document.getElementById('fileInput5');

// Add event listener for file input change for dropzone5
fileInput5.addEventListener('change', function () {
    toggleLabelVisibility(fileInput5, uploadLabel5);
});

// Add event listener for input event to handle the case when files are removed for dropzone5
fileInput5.addEventListener('input', function () {
    toggleLabelVisibility(fileInput5, uploadLabel5);
});

// Get references to elements for dropzone6
const dropzone6 = document.getElementById('dropzone6');
const uploadLabel6 = document.getElementById('uploadLabel6');
const fileInput6 = document.getElementById('fileInput6');

// Add event listener for file input change for dropzone6
fileInput6.addEventListener('change', function () {
    toggleLabelVisibility(fileInput6, uploadLabel6);
});

// Add event listener for input event to handle the case when files are removed for dropzone6
fileInput6.addEventListener('input', function () {
    toggleLabelVisibility(fileInput6, uploadLabel6);
});





// drop and drag activity video 
document.addEventListener('DOMContentLoaded', function () {
    const dropzone = document.getElementById('dropzone6');
    const fileInput = document.getElementById('fileInput6');
    const fileList = document.getElementById('fileList6');
    const uploadForm = document.getElementById('uploadForm');

    let filesArray = [];

    dropzone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropzone.classList.remove('dragover');
        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    dropzone.addEventListener('click', (event) => {
        if (event.target.id !== 'fileInput6' && !event.target.classList.contains('remove-btn')) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    uploadForm.addEventListener('submit', (event) => {
        event.preventDefault();
        submitForm();
    });

    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!filesArray.some(f => f.name === file.name)) {
                filesArray.push(file);
                displayFile(file);
            }
        }
    }

    function displayFile(file) {
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-item');

        let filePreview;
        if (file.type.startsWith('image/')) {
            filePreview = document.createElement('img');
            filePreview.src = URL.createObjectURL(file);
        } else if (file.type.startsWith('video/')) {
            filePreview = document.createElement('video');
            filePreview.src = URL.createObjectURL(file);
            filePreview.controls = true;
        } else {
            // If it's not an image or video, show a placeholder
            filePreview = document.createElement('div');
            filePreview.classList.add('doc-preview');
            filePreview.textContent = file.name; // Placeholder for document
        }

        fileItem.appendChild(filePreview);

        const removeBtn = document.createElement('button');
        removeBtn.classList.add('remove-btn');
        removeBtn.innerHTML = '&times;';
        fileItem.appendChild(removeBtn);

        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerHTML = `
            <strong>Name:</strong> ${file.name}<br>
            <strong>Size:</strong> ${(file.size / 1024).toFixed(2)} KB
        `;
        fileItem.appendChild(tooltip);

        fileList.appendChild(fileItem);

        removeBtn.addEventListener('click', () => {
            fileList.removeChild(fileItem);
            filesArray = filesArray.filter(f => f !== file);
            URL.revokeObjectURL(filePreview.src);
        });

        fileItem.addEventListener('mouseenter', () => {
            tooltip.classList.add('show');
        });

        fileItem.addEventListener('mouseleave', () => {
            tooltip.classList.remove('show');
        });
    }

    function submitForm() {
        const formData = new FormData(uploadForm);
        filesArray.forEach(file => formData.append('handsout[]', file));

        fetch(uploadForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Handle success response
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error response
            });
    }
});


// file upload
document.addEventListener('DOMContentLoaded', function () {
    // Function to handle file input change event
    document.getElementById('file-upload').addEventListener('change', function () {
        // Clear previous previews
        const imagePreviewContainer = document.getElementById('image-preview');
        imagePreviewContainer.innerHTML = '';

        // Loop through each selected file
        Array.from(this.files).forEach(function (file) {
            // Check if the file is an image
            if (file.type.match('image.*')) {
                const reader = new FileReader();

                // Read the image file as a data URL
                reader.readAsDataURL(file);

                // Add an image preview once the file is read
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview';
                    img.style.height = '70px';
                    img.style.width = '100px';
                    img.style.marginRight = '10px';
                    img.style.cursor = 'pointer'; // Add pointer cursor

                    // Show file details on hover
                    img.addEventListener('mouseenter', function () {
                        showFileDetails(file, img);
                    });

                    // Hide file details on mouse leave
                    img.addEventListener('mouseleave', function () {
                        hideFileDetails();
                    });

                    imagePreviewContainer.appendChild(img);
                };
            }
        });
    });
});

function showFileDetails(file, img) {
    const fileInfo = document.createElement('p');
    fileInfo.id = 'file-details-hover';
    fileInfo.textContent = `File Name: ${file.name}, Size: ${formatBytes(file.size)}, Type: ${file.type}`;
    fileInfo.style.position = 'absolute';
    fileInfo.style.bottom = `${img.offsetBottom}px`;
    fileInfo.style.padding = '5px';
    fileInfo.style.fontFamily = 'Inter';
    fileInfo.style.fontWeight = '400';
    fileInfo.style.fontSize = '.7rem';
    fileInfo.style.marginBottom = '1rem';

    // Adjust border style

    img.parentElement.appendChild(fileInfo); // Append file details to the image's parent container
}

// Function to hide file details
function hideFileDetails() {
    const fileInfoHover = document.getElementById('file-details-hover');
    if (fileInfoHover) {
        fileInfoHover.remove();
    }
}

// Function to format file size in human-readable format
function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}


// Get the modal elements
var modals = document.getElementsByClassName("modal");

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    for (var i = 0; i < modals.length; i++) {
        var modal = modals[i];
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

// Function to open a modal
function openModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "block";
}

// Function to close a modal
function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
}

// editcourse

// Function to update image preview when file input changes
function previewImage(event) {
    var imgElement = document.getElementById('img-preview');

    // Check if a file was selected
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        imgElement.src = src;
        imgElement.style.display = 'block'; // Show the image preview
    }
}

// Optional: Initialize preview on page load if course_poster is set
window.addEventListener('DOMContentLoaded', function () {
    var imgElement = document.getElementById('img-preview');
    var currentPoster = "{{ $course->course_poster }}";

    // Check if currentPoster is not empty
    if (currentPoster) {
        imgElement.src = "{{ asset('storage/' . $course->course_poster) }}";
        imgElement.style.display = 'block'; // Show the image preview
    }
});

// edit activity
$(document).ready(function () {
    // When the edit button is clicked
    $('.edit-activity-btn').click(function () {
        var activityId = $(this).data('activity-id');
        // AJAX request to fetch activity data
        $.ajax({
            url: '/activities/' + activityId + '/fetch', // Adjust URL according to your routes
            method: 'GET',
            success: function (response) {
                // Assuming response is JSON data containing activity details
                $('#activity_title').val(response.activity_title);
                $('#activity_number').val(response.activity_number);
                $('#activity_description').val(response.activity_description);
                $('#course_id').val(response.course_id);
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('Failed to fetch activity data.');
            }
        });
    });
});


//handsout-navbar
document.addEventListener('DOMContentLoaded', function () {
    const courseButtons = document.querySelectorAll('.nav-link');

    courseButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get the course ID from the hidden input
            let courseId = document.getElementById('course-id').value;

            // Log the course ID for debugging purposes
            console.log('Course ID:', courseId);

            // Check if courseId is defined
            if (!courseId) {
                console.error('Course ID is undefined');
                return;
            }

            // Log the URL for debugging purposes
            let url = `/course/${courseId}`;
            console.log(`Redirecting to ${url}`);

            // Redirect to the course URL
            window.location.href = url;
        });
    });
});

// ungraded and completed button



