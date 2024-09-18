
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Note App</title>
    <link rel="stylesheet" href="css/note.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    </style>
</head>

<body>
<?php
include_once 'include/login.php';
if (isset($_SESSION['note_insert_errors'])) {
    $_SESSION['displayNoteForm'] = true; // Set to true to display the note form
} else {
    $_SESSION['displayNoteForm'] = false; // Set to false otherwise
}

    ?>
    <div class="wrapper">
    <div class="container">
        <div class="sidebar">
            <img src="img/notelogo.png" alt="ar">
              <ul>
                  <li id="allNotes">All Notes</li>
                  <li id="favorites">Favorites</li>
                  <li id="archives">Archives</li>
                  <li><a href="index.php">Logout</a></li>
              </ul>
          
            <div class="user-info" id="userInfo">
             <button id="editUserInfoBtn">
                <div id="photo">
                <?php 
        $userPhotoPath = isset($_SESSION['user_photo']) ? $_SESSION['user_photo'] : 'img/a.png';
        ?>
        <img src="<?php echo $userPhotoPath; ?>" alt="ADD PHOTO">
                </div>
            
      <div id="name">
     <span>Hi! <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; ?><br>Welcome!</span>
              </div>
                
            </button>

            </div>

            <div id="editUserInfoForm" class="edit">
    <form action="include/edit_user.php" method="POST" enctype="multipart/form-data">
        <span class="close1" id="cancelEditBtn">&times;</span>
        <label for="userName">Name:</label>
        <input type="text" id="userName" name="userName" value="<?php echo $_SESSION['user_name']; ?>"><br><br>
        <label for="userPhoto">Photo:</label>
        <input type="file" id="userPhoto" name="userPhoto" accept="image/*" onchange="previewImage(event)"><br><br>
        <div id="preview-container">
                <img id="preview" src="#" alt="Preview Image">
            </div><br><br>
        <button type="submit">Save Changes</button>
    </form>
</div>



<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
            
            </div>
       

        <div class="left">
            <div class="header">
            <div class="noteApp">
          <h1 id="pageTitle">NoteApp</h1>
          </div>
          <div class="search">
    <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchNotes()">
    
    <button id="addNoteBtn">Add Note</button>
</div>

            </div>
       
            <div class="main-content">
            
            <div class="notes-grid hidden" id="notesGrid">
            <?php
     include_once 'include/db_connectors.php'; // Update this path as needed

     if (!isset($_SESSION['user_id'])) {
     echo "User is not logged in";
     exit(); 
     }

      
            // Fetch regular notes for the logged-in user
            try {
                $conn = connectDB();
                $user_id = $_SESSION['user_id']; 
                $stmt = $conn->prepare("SELECT * FROM notes WHERE u_id = ?");
                $stmt->execute([$user_id]);
                $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        

      ?>

      <?php foreach ($notes as $note): ?>
      
        <div class="note" id="note_<?php echo $note['n_id']; ?>">
            <div class="check">
           
            <input type="checkbox" class="favorite-checkbox" id="checkbox_<?php echo $note['n_id']; ?>" <?php echo $note['is_favorite'] == 1 ? 'checked' : ''; ?>>
            <i class='bx bxs-star'></i>
            <div class="note-header">
                <button class="three-dots" onclick="toggleMenu(this)">...</button> <!-- Three-dot button -->
                <div class="dropdown-menu hidden"> <!-- Dropdown menu initially hidden -->
                    <ul>
                    <li id="viewnote" onclick="viewNote(<?php echo $note['n_id']; ?>)">View</li>
                        <li id="editnote" onclick="editNote(<?php echo $note['n_id']; ?>)">Edit</li>
                        <li id="archivenote" onclick="archiveNote(<?php echo $note['n_id']; ?>)">Archive</li>
                    </ul>
                </div>
                </div>
            </div>
               <div class="note-content">
                  <h3><?php echo $note['title']; ?></h3>
                  <p><br><?php echo nl2br($note['content']); ?></p>
              
               </div>
               <div class="time">
                  <p><?php echo $note['time']; ?></p>
      </div>
               
        </div>
    
        <?php endforeach; ?>
        </div>
        


 <!-- sample -->
 <div class="notes-grid hidden" id="notesGrid1">
            <?php
     include_once 'include/db_connectors.php'; // Update this path as needed

     if (!isset($_SESSION['user_id'])) {
     echo "User is not logged in";
     exit(); 
     }

      
            // Fetch regular notes for the logged-in user
            try {
                $conn = connectDB();
                $user_id = $_SESSION['user_id']; 
                $stmt = $conn->prepare("SELECT * FROM archives WHERE u_id = ?");
                $stmt->execute([$user_id]);
                $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        

      ?>

      <?php foreach ($notes as $note): ?>
      
        <div class="note1" id="note1_<?php echo $note['n_id']; ?>">
            <div class="check">
            <div class="checkstar">
    <input type="checkbox" class="favorite-checkbox" id="checkbox_<?php echo $note['n_id']; ?>" <?php echo $note['is_favorite'] == 1 ? 'checked' : ''; ?>>

        <i class='bx bxs-star'></i> <!-- Star icon -->
  
</div>
             <div class="note-header">
                <button class="three-dots" onclick="toggleMenu(this)">...</button> <!-- Three-dot button -->
                <div class="dropdown-menu hidden"> <!-- Dropdown menu initially hidden -->
                    <ul>
                    <li id="viewnote" onclick="viewNoteArchive(<?php echo $note['n_id']; ?>)">View</li>
                        <li onclick="retrieveNote(<?php echo $note['n_id']; ?>)">Retrieve</li>
                        <li onclick="deleteArchivedNote(<?php echo $note['n_id']; ?>)">Delete</li>
                    </ul>
                </div>
                </div>
            </div>
               <div class="note-content">
                  <h3><?php echo $note['title']; ?></h3>
                  <p><br><?php echo nl2br($note['content']); ?></p>
               </div>
               <div class="time">
                  <p>Last Update: <?php echo $note['time']; ?></p>
                  <p id="archived-time">Archived Time: <?php echo $note['archived_at']; ?></p>
      </div>

               
        </div>
    
        <?php endforeach; ?>
        </div>
        </div>

 <!-- sample -->

        </div>

        </div>
   
     
   
        <div id="addNoteModal" class="modal">
            <span class="close">&times;</span>
            <h2>Add</h2>
            <form action="include/insert_note.php" method="POST">
            <div class="input-box">
    <input type="text" placeholder="Title here..." id="noteTitle" name="noteTitle" value="<?php echo isset($_SESSION['Notesubmitted_values']['noteTitle']) ? htmlspecialchars($_SESSION['Notesubmitted_values']['noteTitle']) : ''; ?>">
    <?php if (isset($_SESSION['note_insert_errors']['noteTitle'])) { echo '<div class="error2">' . $_SESSION['note_insert_errors']['noteTitle'] . '</div>'; } ?>
  
    </div>
    <div class="input-box">
    <textarea id="noteContent" placeholder="Add note here..." name="noteContent"><?php echo isset($_SESSION['Notesubmitted_values']['noteContent']) ? htmlspecialchars($_SESSION['Notesubmitted_values']['noteContent']) : ''; ?></textarea>

    <?php if (isset($_SESSION['note_insert_errors']['noteContent'])) { echo '<div class="error2">' . $_SESSION['note_insert_errors']['noteContent'] . '</div>'; } ?>
   
    </div>
    <button type="submit" id="add">Add Note</button>
</form>
        </div>
 
        </div>
       

        <div id="viewNoteModal" class="modal1">
        <span class="close2">&times;</span>
        <form action="include/update_note.php" method="POST">
        
        <input type="hidden" id="noteIdModal" name="note_id" value="<?php echo isset($_SESSION['Updatesubmitted_values']['note_id']) ? htmlspecialchars($_SESSION['Updatesubmitted_values']['note_id']) : ''; ?>">

        <div class="input-box">
    <input type="text" placeholder="Title here..." id="noteTitleModal" name="noteTitleModal" value="<?php echo isset($_SESSION['Updatesubmitted_values']['noteTitleModal']) ? htmlspecialchars($_SESSION['Updatesubmitted_values']['noteTitleModal']) : ''; ?>">
    <?php if (isset($_SESSION['note_update_errors']['noteTitleModal'])) { echo '<div class="error3">' . $_SESSION['note_update_errors']['noteTitleModal'] . '</div>'; } ?>
  
    </div>
    <div class="input-box">
    <textarea id="noteContentModal" placeholder="Add Note..." name="noteContentModal"><?php echo isset($_SESSION['Updatesubmitted_values']['noteContentModal']) ? htmlspecialchars($_SESSION['Updatesubmitted_values']['noteContentModal']) : ''; ?></textarea>

    <?php if (isset($_SESSION['note_update_errors']['noteContentModal'])) { echo '<div class="error3">' . $_SESSION['note_update_errors']['noteContentModal'] . '</div>'; } ?>
   
    </div>
                <button type="submit" id="add1" >Edit Note</button>
            </form>
         </div>



        <?php include_once 'notescript.php'; ?>

        <?php
// Unset the session variables holding the errors
unset($_SESSION['note_insert_errors']);
unset($_SESSION['note_update_errors']);
unset($_SESSION['Notesubmitted_values']);
unset($_SESSION['Updatesubmitted_values']);
?>
</body>
</html>
