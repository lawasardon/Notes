
<script>
    var modal1 = document.getElementById("addNoteModal");
    var btn1 = document.getElementById("addNoteBtn");
    var span1 = document.getElementsByClassName("close")[0];
    
    const notesGrid = document.getElementById('notesGrid');
            const notesGrid1 = document.getElementById('notesGrid1');
           
            

    function showAddNoteModal() {
        
        document.getElementById('pageTitle').textContent = 'Add Notes';
        notesGrid.classList.add('hidden');
               notesGrid1.classList.add('hidden');
        modal1.style.display = "block";

    }


    function hideAddNoteModal() {
  
        modal1.style.display = "none";
    }

  
    btn1.onclick = function() {
        
        resetNoteForm();
        showAddNoteModal();
    }


    span1.onclick = function() {
      
        hideAddNoteModal();
    }

 
    window.onclick = function(event) {
   
        if (event.target != modal1 && !modal1.contains(event.target) && event.target != btn1) {
            hideAddNoteModal();

        }
    }

   
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const shownoteModal = urlParams.get('shownoteModal');
    const view = urlParams.get('view');
    if (shownoteModal === 'true') {
        setCurrentView(view);
    }
});

</script>





<script>
    var modal = document.getElementById('viewNoteModal');

  
    var closeButton = modal.querySelector('.close2');

    function showUpdateModal() {
      
        modal.style.display = "block";
    }
    closeButton.addEventListener('click', function() {
        resetUpdateForm();
        modal.style.display = 'none';
    });
    window.addEventListener('click', function(event) {
          resetUpdateForm();
        if (event.target != modal && !modal.contains(event.target)) {
            modal.style.display = 'none';
        }
    });


   
</script>


<script>

window.onload = function() {
    <?php if (empty($_SESSION['note_update_errors']) && !empty($_SESSION['note_insert_errors'])) : ?>
        showAddNoteModal();
    <?php endif; ?>

    <?php if (empty($_SESSION['note_insert_errors']) && !empty($_SESSION['note_update_errors'])) : ?>
        showUpdateModal();
    <?php endif; ?>
};

</script>

<script>
    function resetNoteForm() {
        // Clear form fields
       
        document.getElementById('noteTitle').value = '';
        document.getElementById('noteContent').value = '';
        
        // Hide any displayed errors
        var errorElements = document.getElementsByClassName('error2');
        for (var i = 0; i < errorElements.length; i++) {
            errorElements[i].style.display = 'none';
        }
    }


    function resetUpdateForm() {
        // Hide any displayed errors
        var errorElements = document.getElementsByClassName('error3');
        for (var i = 0; i < errorElements.length; i++) {
            errorElements[i].style.display = 'none';
        }
    }
</script>



</script>


<script>
    
    var usernameField = document.getElementById('noteTitle');
    var characterEntered = false;
    var spaceAllowed = false;

    usernameField.addEventListener('keydown', function(event) {
        if (event.keyCode === 32) {
            event.preventDefault();
            if (characterEntered && spaceAllowed) {
                this.value += ' ';
                spaceAllowed = false;
            }
        } else {
            characterEntered = true;
            spaceAllowed = true;
        }
    });
    usernameField.addEventListener('input', function(event) {
        if (event.inputType === 'deleteContentBackward' || event.inputType === 'deleteContentForward') {
            if (!this.value.trim()) {
                characterEntered = false;
                spaceAllowed = false;
            }
        }
    });
</script>




<script>
    
    var usernameField = document.getElementById('noteTitleModal');
    var characterEntered = false;
    var spaceAllowed = false;

    usernameField.addEventListener('keydown', function(event) {
        if (event.keyCode === 32) {
            event.preventDefault();
            if (characterEntered && spaceAllowed) {
                this.value += ' ';
                spaceAllowed = false;
            }
        } else {
            characterEntered = true;
            spaceAllowed = true;
        }
    });
    usernameField.addEventListener('input', function(event) {
        if (event.inputType === 'deleteContentBackward' || event.inputType === 'deleteContentForward') {
            if (!this.value.trim()) {
                characterEntered = false;
                spaceAllowed = false;
            }
        }
    });
</script>









<script>
    // Function to toggle the visibility of the dropdown menu
    function toggleMenu(threeDots) {
        const dropdownMenu = threeDots.nextElementSibling; // Get the next sibling element
        dropdownMenu.classList.toggle('hidden'); // Toggle the 'hidden' class
    }

    // Function to handle the 'View' option
    function viewNote(noteId) {
    // Send an AJAX request to retrieve the note content
    fetch('include/get_note.php?id=' + noteId)
        .then(response => response.json()) // Parse response as JSON
        .then(data => {
            // Check if there's an error
            if (data.error) {
                console.error('Error retrieving note content:', data.error);
                return;
            }

            // Get the modal and modal content elements
            const modal = document.getElementById('viewNoteModal');
            const modalTitle = document.getElementById('noteTitleModal');
            const modalContent = document.getElementById('noteContentModal');
            const editButton = document.getElementById('add1');
            // Set the retrieved note title and content inside the modal
            modalTitle.value = data.title;
            modalContent.textContent = data.content;

            editButton.style.display = 'none';

// Disable the input and textarea
modalTitle.disabled = true;
modalContent.disabled = true;

            // Display the modal
            modal.style.display = 'block';
        })
        .catch(error => {
            console.error('Error retrieving note content:', error);
        });
}


    // Function to handle the 'Edit' option
    function editNote(noteId) {
           // Send an AJAX request to retrieve the note content
    fetch('include/get_note.php?id=' + noteId)
        .then(response => response.json()) // Parse response as JSON
        .then(data => {
            // Check if there's an error
            if (data.error) {
                console.error('Error retrieving note content:', data.error);
                return;
            }

            // Get the modal and modal content elements
            const modal = document.getElementById('viewNoteModal');
            const modalTitle = document.getElementById('noteTitleModal');
            const modalContent = document.getElementById('noteContentModal');
            const editButton = document.getElementById('add1');
            // Set the retrieved note title and content inside the modal
            modalTitle.value = data.title;
            modalContent.textContent = data.content;
            noteIdModal.value = noteId;
            editButton.style.display = 'block'; // Make sure edit button is displayed

// Enable the input and textarea for editing
modalTitle.disabled = false;
modalContent.disabled = false;

// Display the modal
modal.style.display = 'block';


        })
        .catch(error => {
            console.error('Error retrieving note content:', error);
        });
    }

   
    document.getElementById('noteTitleModal').addEventListener('click', function(event) {
    event.stopPropagation();
});
document.getElementById('noteContentModal').addEventListener('click', function(event) {
    event.stopPropagation();
});

    // Function to handle the 'Archive' option
function archiveNote(noteId) {
   
    fetch('include/archive_note.php?id=' + noteId, {
        method: 'POST',
    })
    .then(response => response.json()) // Parse response as JSON
    .then(data => {
        // Check if there's an error
        if (data.error) {
            console.error('Error archiving note:', data.error);
            return;
        }

        // Optionally, you can remove the note from the UI
        const noteElement = document.getElementById('note_' + noteId);
        if (noteElement) {
            noteElement.remove();
        }
      
        const currentView = getCurrentView(); // Define this function to get the current view
        window.location.href = 'note.php?shownoteModal=true&view=' + currentView;
    })
    .catch(error => {
        console.error('Error archiving note:', error);
    });
}
    // Event listener to toggle dropdown menus
    window.addEventListener('click', function(event) {
        const dropdownMenus = document.querySelectorAll('.dropdown-menu');
        const buttons = document.querySelectorAll('.three-dots');
        dropdownMenus.forEach(function(menu, index) {
            if (!menu.contains(event.target) && event.target !== buttons[index]) {
                menu.classList.add('hidden');
            }
        });
    });

   
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const shownoteModal = urlParams.get('shownoteModal');
    const view = urlParams.get('view');
    if (shownoteModal === 'true') {
        document.getElementById('pageTitle').textContent = getPageTitle(view);
        const notesGrid1 = document.getElementById('notesGrid1');
        const notesGrid = document.getElementById('notesGrid');
        if (view === 'favorites') {
            notesGrid1.classList.add('hidden');
            notesGrid.classList.remove('hidden');
            // Show only favorite notes
            const checkboxes = document.querySelectorAll('.favorite-checkbox');
            checkboxes.forEach(function(checkbox) {
                const noteId = checkbox.id.split('_')[1];
                const noteDiv = document.getElementById('note_' + noteId);
                if (!checkbox.checked) {
                    noteDiv.style.display = 'none';
                } else {
                    noteDiv.style.display = 'block';
                }
            });
        } else if (view === 'allNotes') {
            notesGrid1.classList.add('hidden');
            notesGrid.classList.remove('hidden');
            // Show all notes
            const notes = document.querySelectorAll('.note');
            notes.forEach(function(note) {
                note.style.display = 'block';
            });
        }
        // Remove the query parameter from the URL
        const newUrl = window.location.href.split('?')[0];
        history.replaceState({}, document.title, newUrl);
    }
});

function getPageTitle(view) {
    if (view === 'favorites') {
        return 'Favorites';
    } else if (view === 'allNotes') {
        return 'All Notes';
    }
}

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

const sidebarItems = document.querySelectorAll('.sidebar ul li');
function removeActiveClass() {
    sidebarItems.forEach(function(item) {
        item.classList.remove('active');
    });
}

const activeSidebarItem = localStorage.getItem('activeSidebarItem');
    if (activeSidebarItem) {
        document.getElementById(activeSidebarItem).classList.add('active');
    }

        // Event listener for the "All Notes" option
        document.getElementById('allNotes').addEventListener('click', function () {
            // Remove the 'hidden' class from the notes grid
            const notesGrid = document.getElementById('notesGrid');
            const notesGrid1 = document.getElementById('notesGrid1');
            notesGrid.classList.remove('hidden');
               notesGrid1.classList.add('hidden');
               
            // Update the page title
            document.getElementById('pageTitle').textContent = 'All Notes';

            // Display all notes
            const notes = document.querySelectorAll('.note');
            notes.forEach(function(note) {
                note.style.display = 'block';
            });
            removeActiveClass();
            document.getElementById('allNotes').classList.add('active');
            localStorage.setItem('activeSidebarItem', 'allNotes');
        });

        // Event listener for the "Favorites" option
        document.getElementById('favorites').addEventListener('click', function () {
            // Remove the 'hidden' class from the notes grid
            const notesGrid = document.getElementById('notesGrid');
            notesGrid.classList.remove('hidden');
            const notesGrid1 = document.getElementById('notesGrid1');
               notesGrid1.classList.add('hidden');

            // Update the page title
            document.getElementById('pageTitle').textContent = 'Favorites';

            // Get all the checkboxes
            const checkboxes = document.querySelectorAll('.favorite-checkbox');

            // Hide notes that are not checked
            checkboxes.forEach(function(checkbox) {
                const noteId = checkbox.id.split('_')[1];
                const noteDiv = document.getElementById('note_' + noteId);
                if (!checkbox.checked) {
                    noteDiv.style.display = 'none';
                    removeActiveClass();
                
                    document.getElementById('favorites').classList.add('active');
                    localStorage.setItem('activeSidebarItem', 'favotires');
          
                } else {
                    noteDiv.style.display = 'block';
                    removeActiveClass();
                    document.getElementById('favorites').classList.add('active');
                    localStorage.setItem('activeSidebarItem', 'favotires');
                }
             
            });
            
   
        });



        document.getElementById('archives').addEventListener('click', function () {
            // Remove the 'hidden' class from the notes grid
            const notesGrid1 = document.getElementById('notesGrid1');
            const notesGrid = document.getElementById('notesGrid');
            notesGrid1.classList.remove('hidden');
               notesGrid.classList.add('hidden');
               window.location.href = 'note.php?showArchiveModal=true';
               // Select and disable checkboxes
    const checkboxes = document.querySelectorAll('[id^="checkbox1_"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.disabled = true;
    });

            // Update the page title
            document.getElementById('pageTitle').textContent = 'Archives';

            // Display all notes
            const notes = document.querySelectorAll('.note1');
            notes.forEach(function(note) {
                note.style.display = 'block';
            });
           
            removeActiveClass();
            document.getElementById('archives').classList.add('active');
               // Store the active state in localStorage
    localStorage.setItem('activeSidebarItem', 'archives');
          
        });
    });
</script>







<Script>
// JavaScript code to handle favorite checkbox state change
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.favorite-checkbox');
    checkboxes.forEach(function(checkbox) {
        const noteId = checkbox.id.split('_')[1];
        checkbox.addEventListener('change', function() {
            const isChecked = checkbox.checked;
            // Send AJAX request to update favorite status in the database
            updateFavoriteStatus(noteId, isChecked);
        });
    });
});

// Function to send AJAX request to update favorite status in the database
function updateFavoriteStatus(noteId, isChecked) {
    // Send an AJAX request to update favorite status in the database
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle response if needed
            console.log(xhr.responseText);
        }
    };
    xhr.open('POST', 'include/update_favorite_status.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`noteId=${noteId}&isChecked=${isChecked ? 1 : 0}`);
}

</Script>







<script>
document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('editUserInfoBtn');
    const editForm = document.getElementById('editUserInfoForm');
    const cancelBtn = document.getElementById('cancelEditBtn');

    editBtn.addEventListener('click', function () {
        editForm.style.display = 'block';
    });

   // Hide the edit form when the cancel button is clicked
   cancelBtn.addEventListener('click', function () {
        editForm.style.display = 'none';
    });

    document.addEventListener('click', function (event) {
    // Check if the clicked element is not within the edit form or edit button
    if (!editForm.contains(event.target) && !editBtn.contains(event.target)) {
        editForm.style.display = 'none';
    }
});
});
</script>


<script>
   document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const showArchiveModal = urlParams.get('showArchiveModal');
    if (showArchiveModal === 'true') {
        // Display the archive modal
        document.getElementById('pageTitle').textContent = 'Archives';
        const notesGrid1 = document.getElementById('notesGrid1');
        const notesGrid = document.getElementById('notesGrid');
        notesGrid1.classList.remove('hidden');
        notesGrid.classList.add('hidden');

        // Remove the query parameter from the URL
        const newUrl = window.location.href.split('?')[0];
        history.replaceState({}, document.title, newUrl);
    }
});

</script>

<script>
    function deleteArchivedNote(noteId) {
    // Make an AJAX request to the PHP script to delete the archived note
    fetch('include/delete_note.php?id=' + noteId)
        .then(response => response.json())
        .then(data => {
            // Check if deletion was successful
            if (data.success) {
                // Reload the page with a query parameter indicating to display the archive modal
                window.location.href = 'note.php?showArchiveModal=true';
                alert('Delete Note Permanently.');
            } else {
                // Handle error
                console.error(data.error);
                alert('Error deleting archived note');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting archived note');
        });
}



    function retrieveNote(noteId) {
    // Send an AJAX request to archive the note
    fetch('include/retrieve_note.php?id=' + noteId, {
        method: 'POST',
    })
    .then(response => response.json()) // Parse response as JSON
    .then(data => {
        // Check if there's an error
        if (data.error) {
            console.error('Error archiving note:', data.error);
            return;
        }

        // Optionally, you can remove the note from the UI
        const noteElement = document.getElementById('note1_' + noteId);
        if (noteElement) {
            noteElement.remove();
        }  alert('Retrieve Note.');
        window.location.href = 'note.php?showArchiveModal=true';
    })
    .catch(error => {
        console.error('Error archiving note:', error);
    });
}
</script>

<script>

function viewNoteArchive(noteId) {
    // Send an AJAX request to retrieve the note content
    fetch('include/archive.php?id=' + noteId)
        .then(response => response.json()) // Parse response as JSON
        .then(data => {
            // Check if there's an error
            if (data.error) {
                console.error('Error retrieving note content:', data.error);
                return;
            }

            // Get the modal and modal content elements
            const modal = document.getElementById('viewNoteModal');
            const modalTitle = document.getElementById('noteTitleModal');
            const modalContent = document.getElementById('noteContentModal');
            const editButton = document.getElementById('add1');
            // Set the retrieved note title and content inside the modal
            modalTitle.value = data.title;
            modalContent.textContent = data.content;

            editButton.style.display = 'none';

// Disable the input and textarea
modalTitle.disabled = true;
modalContent.disabled = true;

            // Display the modal
            modal.style.display = 'block';
        })
        .catch(error => {
            console.error('Error retrieving note content:', error);
        });
}
</script>





<script>
    function searchNotes() {
    var input, filter, grid, notes, note, title, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    grid = document.getElementById('notesGrid');
    notes = grid.getElementsByClassName('note');

    for (i = 0; i < notes.length; i++) {
        note = notes[i];
        title = note.getElementsByTagName('h3')[0];
        txtValue = title.textContent || title.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            note.style.display = '';
        } else {
            note.style.display = 'none';
        }
    }
}

</script>


